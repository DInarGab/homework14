<?php
declare(strict_types=1);

namespace App\Application\News\GetNewsUseCase;

use App\Infrastructure\News\Repository\NewsRepository;

class GetNewsUseCase
{
    public function __construct(
        private NewsRepository $newsRepository,
    )
    {

    }
    public function __invoke()
    {
        $news =  $this->newsRepository->findAll();
        return new GetNewsResponse($news);
    }
}
