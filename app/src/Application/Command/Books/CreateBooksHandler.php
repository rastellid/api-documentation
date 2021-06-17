<?php

declare(strict_types=1);

namespace App\Application\Command\Books;

use App\Domain\Books\Book;
use App\Infrastructure\Database\Book\Command\BookRepository;
use Ramsey\Uuid\Uuid;

class CreateBooksHandler
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function __invoke(CreateBooks $command): void
    {
        $book = new Book(
            Uuid::uuid4(),
            $command->title(),
            $command->author(),
            $command->price()
        );

        $this->bookRepository->store($book);
    }
}
