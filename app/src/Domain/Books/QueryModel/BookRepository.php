<?php

declare(strict_types=1);

namespace App\Domain\Books\QueryModel;

use App\Application\QueryModel\Book\Book;

interface BookRepository
{
    public function all(): array;

    public function get(string $bookId): Book;
}
