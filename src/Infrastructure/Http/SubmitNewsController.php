<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\News\UseCase\SubmitNewsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SubmitNewsController extends AbstractController
{

    public function __construct(private SubmitNewsUseCase $submitNewsUseCase)
    {

    }

    /**
     * @param SubmitNewsRequest $request
     * @return JsonResponse
     */
    public function __invoke(SubmitNewsRequest $request): JsonResponse
    {
        try {
            $response = ($this->submitNewsUseCase)($request);
            return $this->json($response, 201);
        } catch (\Exception $exception) {
            return $this->json([$exception->getMessage()], 400);
        }
    }
}
