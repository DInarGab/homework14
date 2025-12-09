<?php
declare(strict_types=1);

namespace App\Application\News\UseCase;


use App\Domain\News\Factory\NewsFactoryInterface;
use App\Domain\News\Factory\NewsSourceFactoryInterface;
use App\Domain\News\Repository\NewsRepositoryInterface;
use App\Domain\Service\DocumentLoaderInterface;

class SubmitNewsUseCase
{
    public function __construct(
        private readonly DocumentLoaderInterface $documentLoader,
        private readonly NewsFactoryInterface $newsFactory,
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly NewsSourceFactoryInterface $newsSourceFactory
    )
    {

    }

    /**
     * @param SubmitNewsRequest $newsRequest
     * @return SubmitNewsResponse
     */
    public function __invoke(SubmitNewsRequest $newsRequest): SubmitNewsResponse
    {
        //Спарсить страницу новости
        $newsSource = $this->newsSourceFactory->create($newsRequest->url);
        $news = $this->documentLoader->fetch($newsSource, $this->newsFactory);
        // Сохранить новость в БД или на Диск.
        $this->newsRepository->save($news);
        // Вернуть результат
        return new SubmitNewsResponse(
            $news->getId()
        );
    }
}
