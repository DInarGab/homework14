<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Report\DTO\GenerateReportRequest;
use App\Application\Report\UseCase\GenerateReportUseCase;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class GenerateReportController extends AbstractController
{

    public function __construct(
        private GenerateReportUseCase $reportUseCase,
        private UrlHelper $urlHelper,
    ) {
    }

    #[Route('/api/report/', name: 'api_get_news_link', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] GenerateReportRequest $request
    ): JsonResponse {
        if (empty($request->newsIds)) {
            return $this->json(['error' => 'News IDs is required.'], 400);
        }

        try {
            $response = ($this->reportUseCase)($request);

            return $this->json([
                'reportUrl' => $this->urlHelper->getAbsoluteUrl($response->filePath)
            ], 200);
        } catch (Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 400);
        }
    }
}
