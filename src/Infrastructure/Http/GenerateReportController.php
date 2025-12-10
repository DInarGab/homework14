<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Report\UseCase\GenerateReportRequest;
use App\Application\Report\UseCase\GenerateReportUseCase;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class GenerateReportController extends AbstractController
{

    public function __construct(
        private GenerateReportUseCase $reportUseCase,
        private UrlHelper             $urlHelper,
        #[Autowire('%kernel.project_dir%')]
        private readonly string       $projectDir,
    )
    {
    }

    #[Route('/api/report/', name: 'api_get_news_link', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] GenerateReportRequest $request
    ): JsonResponse
    {
        if (empty($request->newsId)) {
            return $this->json(['error' => 'News ID is required.'], 400);
        }

        try {
            $response = ($this->reportUseCase)($request);
            return $this->json([
                'reportUrl' => $this->getReportUrlFromPath($response->filePath)
            ], 200);
        } catch (Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 400);
        }
    }

    private function getReportUrlFromPath(string $absoluteFilePath): string
    {
        $publicDir = $this->projectDir . '/public/';

        if (strpos($absoluteFilePath, $publicDir) === 0) {
            $relativePath = substr($absoluteFilePath, strlen($publicDir));

            $url = $this->urlHelper->getAbsoluteUrl('/' . $relativePath);

            return $url;
        } else {
            throw new InvalidArgumentException("File is not accessible via the web public directory.");
        }
    }

}
