<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use App\Application\QueryModel\Book\Book;
use App\Infrastructure\Database\Book\QueryModel\BookRepository;
use Doctrine\ORM\NoResultException;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api')]
class BookController
{
    #[Route('/books', name: 'new_book', methods: ['POST'])]
    public function addBookAction(MessageBusInterface $bus, Request $request, SerializerInterface $serializer): Response
    {
        $book = $serializer->deserialize($request->getContent(), CreateBooks::class, 'json');

        $bus->dispatch($book);

        return new JsonResponse('OK in POST');
    }

    #[Route('/books', name: 'get_all_books', methods: ['GET'])]

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of books",
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=Book::class, groups={"default"}))
     *     )
     * )
     * @OA\Response(
     *     response="404",
     *     description="List of books not found"
     * )
     */
    public function allBooksAction(BookRepository $bookRepository): Response
    {
        return new JsonResponse($bookRepository->all());
    }

    #[Route('/book/{bookId}', name: 'get_specific_book_by_id', methods: ['GET'])]
    /**
     *
     * @OA\Response(
     *     response=200,
     *     description="Return specific book",
     *     @OA\JsonContent(
     *     ref=@Model(type=Book::class, groups={"default"}))
     *     )
     * ),
     * @OA\Parameter(
     *     description="Book id",
     *     in="path",
     *     name="bookId",
     *     required=true,
     * ),
     * @OA\Response(
     *     response=404,
     *     description="Book not found"
     * )
     */
    public function bookAction(string $bookId, BookRepository $bookRepository): Response
    {
        try {
            return new JsonResponse($bookRepository->get($bookId));
        } catch (NoResultException $e) {
            return new JsonResponse('Book not found', 404);
        }
    }
}
