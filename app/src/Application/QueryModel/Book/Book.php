<?php

declare(strict_types=1);

namespace App\Application\QueryModel\Book;

class Book implements \JsonSerializable
{
    public function __construct(
        private string $id,
        private string $title,
        private string $author,
        private float $price
    ) {
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price
        ];
    }
}
