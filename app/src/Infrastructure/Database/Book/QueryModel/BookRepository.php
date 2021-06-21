<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Book\QueryModel;

use App\Application\QueryModel\Book\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookRepository implements \App\Domain\Books\QueryModel\BookRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    /** @return array<array-key, Book> */
    public function all(): array
    {
        $dql = $this->entityManager->createQuery(<<<DQL
SELECT NEW App\Application\QueryModel\Book\Book(
    b.id,
    b.title,
    b.author,
    b.price
)
FROM App\Domain\Books\Book b
DQL);

        return $dql->getResult();
    }
}
