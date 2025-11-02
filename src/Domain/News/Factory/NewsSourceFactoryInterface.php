<?php
declare(strict_types=1);

namespace App\Domain\News\Factory;

use App\Domain\News\Entity\NewsSource;

interface NewsSourceFactoryInterface
{
    public function create(string $url): NewsSource;
}
