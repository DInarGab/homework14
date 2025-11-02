<?php
declare(strict_types=1);

namespace App\Domain\News\Entity;

use App\Domain\ValueObject\Url;

class NewsSource
{
    public function __construct(private readonly Url $url)
    {

    }

    public function getUrl(): Url
    {
        return $this->url;
    }
}
