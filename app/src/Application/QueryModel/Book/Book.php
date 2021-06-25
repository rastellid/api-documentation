<?php

declare(strict_types=1);

namespace App\Application\QueryModel\Book;

use OpenApi\Annotations as OA;

/**
 * @psalm-immutable
 * @OA\Schema(
 *     type="object",
 *     @OA\Property(type="string", nullable=false, property="id", example="51deeb8c-7491-443e-9928-9146083c8981"),
 *     @OA\Property(type="string", nullable=false, property="title", example="Inferno"),
 *     @OA\Property(type="string", nullable=false, property="author", example="Down Brown"),
 *     @OA\Property(type="float", nullable=false, property="price", example="103.42"),
 *     example={"id": "51deeb8c-7491-443e-9928-9146083c8981", "title": "Inferno", "author": "Down Brown", "price": 103.40}
 * )
 */
class Book implements \JsonSerializable
{
    public function __construct(
        /**
         * @OA\Property(type="string", nullable=false, property="id", example="51deeb8c-7491-443e-9928-9146083c8981")
         */
        public string $id,
        public string $title,
        public string $author,
        public float $price
    ) {
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price,
        ];
    }
}
