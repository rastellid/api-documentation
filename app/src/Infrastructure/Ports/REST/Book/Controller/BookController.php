<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class BookController
{
    #[Route(path: 'add-book', methods: ['POST'])]
    public function second(MessageBusInterface $bus, Request $request): JsonResponse
    {
        $book = json_decode($request->getContent(), true);

        $bus->dispatch(new CreateBooks(...$book));

        return new JsonResponse('OK in POST');
    }
}
