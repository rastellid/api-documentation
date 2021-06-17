<?php

declare(strict_types=1);

namespace App\Domain\Books\Command;

use App\Domain\Books\Book;

interface BookRepository
{
    public function store(Book $book): void;
}
