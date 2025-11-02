<?php
declare(strict_types=1);

namespace App\Domain\Service;



use App\Application\News\Factory\NewsFactory;
use App\Domain\News\Entity\News;
use App\Domain\News\Entity\NewsSource;

interface DocumentLoaderInterface
{
    public function fetch(NewsSource $newsSource, NewsFactory $newsFactory): News;
//    public function extractTitle(string $htmlContent): string;
}
