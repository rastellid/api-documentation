<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Fixtures;

use App\Domain\Books\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book = new Book(
            Uuid::uuid4(),
            'Inferno',
            'Dan Brown',
            103.4
        );

        $manager->persist($book);
        $manager->flush();
    }
}
