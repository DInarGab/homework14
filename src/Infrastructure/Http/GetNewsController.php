<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\News\DTO\NewsDTO;
use App\Application\News\GetNewsUseCase\GetNewsUseCase;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetNewsController extends AbstractController
{
    public function __construct(
        private GetNewsUseCase $useCase
    ) {
    }

    #[Route('/api/news/', name: 'get_news', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        try {
            $newsResponse = ($this->useCase)();

            return $this->json([
                "news" => array_map(fn(NewsDTO $newsDto) => $newsDto->asArray(), $newsResponse->news)
            ], 200);
        } catch (Exception $e) {
            return $this->json(["error" => $e->getMessage()], 400);
        }
    }
}
