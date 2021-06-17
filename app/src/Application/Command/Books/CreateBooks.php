<?php

declare(strict_types=1);

namespace App\Application\Command\Books;

class CreateBooks
{
    public function __construct(
        private string $title,
        private string $author,
        private float $price
    ) {
    }

    public function title(): string
    {
        return $this->title;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function price(): float
    {
        return $this->price;
    }
}
