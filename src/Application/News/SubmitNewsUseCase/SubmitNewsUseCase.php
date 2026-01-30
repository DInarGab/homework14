<?php
declare(strict_types=1);

namespace App\Application\News\SubmitNewsUseCase;


use App\Application\News\Service\DocumentLoaderInterface;
use App\Domain\News\Factory\NewsFactoryInterface;
use App\Domain\News\Repository\NewsRepositoryInterface;
use App\Domain\ValueObject\Url;

class SubmitNewsUseCase
{
    public function __construct(
        private readonly DocumentLoaderInterface $documentLoader,
        private readonly NewsFactoryInterface $newsFactory,
        private readonly NewsRepositoryInterface $newsRepository,
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

        $content = $this->documentLoader->fetch(new Url($newsRequest->url));
        $news = $this->newsFactory->create($content->title, $newsRequest->url);
        // Сохранить новость в БД или на Диск.
        $this->newsRepository->save($news);
        // Вернуть результат
        return new SubmitNewsResponse(
            $news->getId()
        );
    }
}
