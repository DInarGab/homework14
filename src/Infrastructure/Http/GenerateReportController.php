<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Report\UseCase\GenerateReportRequest;
use App\Application\Report\UseCase\GenerateReportUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class GenerateReportController extends AbstractController
{

    public function __construct(private GenerateReportUseCase $reportUseCase)
    {
    }

    #[Route('/api/report/', name: 'api_get_news_link', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] GenerateReportRequest $request
    ): JsonResponse
    {
        try {
            $response = ($this->reportUseCase)($request);
            return $this->json($response->asArray(), 200);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 400);
        }
    }
}
