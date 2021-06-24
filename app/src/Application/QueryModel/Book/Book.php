<?php

declare(strict_types=1);

namespace App\Application\QueryModel\Book;
use OpenApi\Annotations as OA;

/**
 * @psalm-immutable
 */
class Book implements \JsonSerializable
{
    public function __construct(
        /**
         * @var string
         * @OA\Property(description="The unique identifier of the user.")
         */
        public string $id,

        /**
         * @OA\Property(description="The unique identifier of the user.")
         */
        public string $title,

        /**
         * @OA\Property(description="The unique identifier of the user.")
         */
        public string $author,

        /**
         * @var string
         * @OA\Property(description="The unique identifier of the user.")
         */
        public float $price
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
