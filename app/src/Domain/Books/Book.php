<?php

declare(strict_types=1);

namespace App\Domain\Books;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/** @ORM\Entity */
class Book
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    /** @ORM\Column(type="string", name="title") */
    private $title;

    /** @ORM\Column(type="string", name="author")*/
    private $author;

    /** @ORM\Column(type="decimal", name="price", precision=6, scale=2) */
    private $price;

    public function __construct(
        UuidInterface $id,
        string $title,
        string $author,
        float $price
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }
}
