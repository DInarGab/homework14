<?php
declare(strict_types=1);

namespace App\Application\News\Factory;

use App\Domain\News\Entity\NewsSource;
use App\Domain\News\Factory\NewsSourceFactoryInterface;
use App\Domain\ValueObject\Url;

class NewsSourceFactory implements NewsSourceFactoryInterface
{

    public function create(string $url): NewsSource
    {
        return new NewsSource(
            new Url($url)
        );
    }
}
