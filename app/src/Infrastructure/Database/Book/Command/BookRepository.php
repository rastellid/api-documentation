<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Book\Command;

use App\Domain\Books\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookRepository implements \App\Domain\Books\Command\BookRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function store(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
