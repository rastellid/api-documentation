<?php

declare(strict_types=1);

namespace App\Tests\Functional\Book;

use App\Tests\Functional\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
   public function test_first_test(): void
   {
       Client::instance()->get('/api/book')->isOK()->isJsonResponse();
   }
}