<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use App\Application\QueryModel\Book\Book;
use App\Infrastructure\Database\Book\QueryModel\BookRepository;
use Doctrine\ORM\NoResultException;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api')]
class BookController
{
    #[Route('/book', name: 'new_book', methods: ['POST'])]

    /**
     * @OA\RequestBody(
     *     @OA\JsonContent(
     *         ref=@Model(type=CreateBooks::class, groups={"book"})
     *     )
     * ),
     * @OA\Response(
     *     response="201",
     *     description="Book created"
     * ),
     * @OA\Response(
     *     response="405",
     *     description="Invalid Input"
     * )
     * @OA\Tag(name="Book")
     */
    public function addBookAction(MessageBusInterface $bus, Request $request, SerializerInterface $serializer): Response
    {
        try {
            $book = $serializer->deserialize($request->getContent(), CreateBooks::class, 'json');

            $bus->dispatch($book);

            return new JsonResponse('Book Created', 201);
        } catch (MissingConstructorArgumentsException $e) {
            return new JsonResponse('Invalid input', 405);
        }
    }

    #[Route('/book', name: 'get_all_books', methods: ['GET'])]

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of books",
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=Book::class, groups={"book"}))
     *     )
     * )
     * @OA\Response(
     *     response="404",
     *     description="List of books not found"
     * ),
     * @OA\Tag(name="Book")
     */
    public function allBooksAction(BookRepository $bookRepository): Response
    {
        return new JsonResponse($bookRepository->all());
    }

    #[Route('/book/{bookId}', name: 'get_specific_book_by_id', methods: ['GET'])]

    /**
     * @OA\Response(
     *     response=200,
     *     description="Return specific book",
     *     @OA\JsonContent(
     *         ref=@Model(type=Book::class, groups={"book"})
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
     * ),
     * @OA\Tag(name="Book")
     */
    public function bookAction(string $bookId, BookRepository $bookRepository): Response
    {
        try {
            return new JsonResponse($bookRepository->get($bookId));
        } catch (NoResultException $e) {
            return new JsonResponse('Book not found', 404);
        }
    }

    #[Route('/psr7', name: 'test_psr_7', methods: ['GET'])]
    public function psr7Action(ServerRequestInterface $request)
    {
        dump($request->ge());
        exit;
    }
}
