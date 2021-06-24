<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use App\Infrastructure\Database\Book\QueryModel\BookRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use App\Application\QueryModel\Book\Book;

class BookController
{
    #[Route('/api/books', name: 'new_book', methods: ['POST'])]
    public function addBookAction(MessageBusInterface $bus, Request $request, SerializerInterface $serializer): JsonResponse
    {
        $book = $serializer->deserialize($request->getContent(), CreateBooks::class, 'json');

        $bus->dispatch($book);

        return new JsonResponse('OK in POST');
    }

    #[Route('/api/books', name: 'get_all_books', methods: ['GET'])]
    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of books",
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Book::class, groups={"full"}))
     *     )
     * )
     * @OA\Response(
     *     response="404",
     *     description="List of books not found"
     * )
     *
     */
    public function allBooksAction(BookRepository $bookRepository): JsonResponse
    {
       return new JsonResponse($bookRepository->all());
    }
}
