<?php

declare(strict_types=1);

namespace App\Application\Command\Books;
use OpenApi\Annotations as OA;

/**
 * @psalm-immutable
 * @OA\Schema(
 *     type="object",
 *     @OA\Property(type="string", nullable=false, property="title", example="Inferno"),
 *     @OA\Property(type="string", nullable=false, property="author", example="Down Brown"),
 *     @OA\Property(type="float", nullable=false, property="price", example="103.42"),
 *     example={"title": "Inferno", "author": "Down Brown", "price": 103.40}
 * )
 */
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
