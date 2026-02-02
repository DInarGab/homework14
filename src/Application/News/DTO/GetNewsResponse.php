<?php

declare(strict_types=1);

namespace App\Application\News\DTO;

use App\Domain\News\Entity\News;
use InvalidArgumentException;

class GetNewsResponse
{
    /**
     * @var array<NewsDTO>
     */
    public array $news = [];

    public function __construct(
        array $news
    ) {
        foreach ($news as $newsItem) {
            if ($newsItem instanceof News) {
                $this->news[] = NewsDTO::fromEntity($newsItem);
            } else {
                throw new InvalidArgumentException('Response must contain only instances of News entity.');
            }
        }
    }
}
