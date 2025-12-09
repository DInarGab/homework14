<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\News\GetNewsUseCase\GetNewsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetNewsController extends AbstractController
{
    public function __construct(
        private GetNewsUseCase $useCase
    )
    {

    }

    #[Route('/api/news/', name: 'get_news', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $newsArray = ($this->useCase)();
        return $this->json($newsArray->asArray(), 200);
    }
}
