<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use App\Application\Command\Books\CreateBooks;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    #[Route(path: 'first-controller', methods: ['GET'])]
    public function first(): JsonResponse
    {
        return new JsonResponse('OK in Get');
    }

    #[Route(path: 'second-controller', methods: ['POST'])]
    public function second(MessageBusInterface $bus): JsonResponse
    {
        $bus->dispatch(new CreateBooks('Il Signore degli Anelli', 'Tolkien', 60.33));

        return new JsonResponse('OK in POST');
    }
}
