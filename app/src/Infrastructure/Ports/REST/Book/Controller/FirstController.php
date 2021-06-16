<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports\REST\Book\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    #[Route(path: 'first-controller', methods: ['GET'])]
    public function first(): JsonResponse
    {
        return new JsonResponse('OK in Get');
    }

    #[Route(path: 'second-controller', methods: ['POST'])]
    public function second(Request $request): JsonResponse
    {
        return new JsonResponse('OK in POST');
    }
}
