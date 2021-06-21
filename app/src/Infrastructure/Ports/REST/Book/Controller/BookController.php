<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use App\Infrastructure\Database\Book\QueryModel\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/books')]
class BookController
{
    #[Route(path: '/add', methods: ['POST'])]
    public function addBookAction(MessageBusInterface $bus, Request $request, SerializerInterface $serializer): JsonResponse
    {
        $book = $serializer->deserialize($request->getContent(), CreateBooks::class, 'json');

        $bus->dispatch($book);

        return new JsonResponse('OK in POST');
    }

    #[Route(path: '/all', methods: ['GET'])]
    public function allBooksAction(BookRepository $bookRepository): JsonResponse
    {
       return new JsonResponse($bookRepository->all());
    }
}
