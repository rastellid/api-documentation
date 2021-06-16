<?php

namespace App\Infrastructure\Ports\REST\Book\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FirstController
{
    #[Route(path: 'first-controller', methods: ['GET'])]
    public function first(): JsonResponse
    {
        return new JsonResponse('ok');
    }
}