<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\News\UseCase\SubmitNewsRequest;
use App\Application\News\UseCase\SubmitNewsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class SubmitNewsController extends AbstractController
{

    public function __construct(private SubmitNewsUseCase $submitNewsUseCase)
    {

    }

    /**
     * @param SubmitNewsRequest $request
     * @return JsonResponse
     */
    #[Route('/api/news', name: 'add_news', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] SubmitNewsRequest $request
    ): JsonResponse
    {
        try {
            $response = ($this->submitNewsUseCase)($request);
            return $this->json($response, 201);
        } catch (\Exception $exception) {
            return $this->json([$exception->getMessage()], 400);
        }
    }
}
