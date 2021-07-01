<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
       self::assertEquals('application/json', $this->client->getResponse()->headers->get('Content-Type'));
       return  $this;
   }
}