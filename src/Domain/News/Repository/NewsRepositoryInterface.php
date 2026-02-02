<?php

declare(strict_types=1);

namespace App\Domain\News\Repository;


use App\Domain\News\Entity\News;

interface NewsRepositoryInterface
{

    /**
     * @param array $ids Массив Id новостей для поиска
     *
     * @return array<News>
     */
    public function getByIds(array $ids): array;

    /**
     *
     * @return array<News>
     **/
    public function getAll(): array;


    public function save(News $news): void;

//    public function delete(News $news): void;
}
