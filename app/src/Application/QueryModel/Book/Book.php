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
         * @OA\Property(type="string", nullable=false, propertyNames="id")
         * @var string $id
         */
        public string $id,

        /**
         * @OA\Property(type="string", nullable=false, propertyNames="title")
         * @var string $title
         */
        public string $title,

        /**
         * @OA\Property(type="string", nullable=false, propertyNames="author")
         * @var string $author
         */
        public string $author,

        /**
         * @OA\Property(type="string", nullable=false, propertyNames="price")
         * @var float $price
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
