<?php
declare(strict_types=1);

namespace App\Application\News\GetNewsUseCase;

use App\Domain\News\Entity\News;

class GetNewsResponse
{
    public array $news = [];

    public function __construct(
        array $news
    )
    {
        foreach ($news as $newsItem) {
            if ($newsItem instanceof News) {
                $this->news[] = $newsItem;
            } else {
                throw new \InvalidArgumentException('Response must contain only instances of News entity.');
            }
        }
    }

    public function asArray(): array
    {
        $returnArray = [];
        foreach ($this->news as $news) {
            $returnArray[] = [
                'id' => $news->getId(),
                'title' => $news->getTitle()->getValue(),
                'date' => $news->getDate()->format('Y-m-d'),
                'url' => $news->getUrl()->getValue(),
            ];
        }
        return $returnArray;
    }
}
