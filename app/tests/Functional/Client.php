<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use JsonSchema\Exception\ValidationException;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use phpDocumentor\Reflection\Types\Void_;
use Phpro\ApiProblem\Exception\ApiProblemException;
use Phpro\ApiProblem\Exception;
use Phpro\ApiProblem\Http\HttpApiProblem;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class Client extends WebTestCase
{
   private static $instance;

   private KernelBrowser $client;

   public static function instance(): self
   {
       if (null === self::$instance) {
           $client = new self();
           $client->client = self::createClient();
           self::$instance = $client;
       }

       return self::$instance;
   }

   public function get(string $url): self
   {
       $client = self::instance();
       $client->client->request('GET', $url);

       return $client;
   }

   public function isOK(): self
   {
       self::assertResponseIsSuccessful();
       return  $this;
   }

   public function isJsonResponse(): self
   {
       $this->isValidRequest($this->client->getResponse());
       self::assertEquals('application/json', $this->client->getResponse()->headers->get('Content-Type'));
       return  $this;
   }


   private function isValidRequest(Response $response): void
   {
       $service = self::getContainer()->get(HttpMessageFactoryInterface::class);
       $responsePSR7 = $service->createResponse($response);
       $validator = (new ValidatorBuilder)->fromJsonFile('/var/www/app/openapi.json')->getResponseValidator();
       $operation = new OperationAddress('/api/book', 'get') ;

       $validator->validate($operation, $responsePSR7);
   }
}