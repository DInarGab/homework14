<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Report\UseCase\GenerateReportRequest;
use App\Application\Report\UseCase\GenerateReportUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class GetNewsController extends AbstractController
{

    public function __construct(private GenerateReportUseCase $reportUseCase)
    {
    }

    #[Route('/api/news/', name: 'api_get_news_link', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString] GenerateReportRequest $request
    )
    {
        try {
            $response = ($this->reportUseCase)($request);
            return $this->json($response, 200);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 400);
        }
    }
}
