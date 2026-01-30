<?php
declare(strict_types=1);

namespace App\Application\News\Service;



use App\Application\Report\Service\DTO\DocumentDTO;
use App\Domain\ValueObject\Url;

interface DocumentLoaderInterface
{
    public function fetch(Url $newsSource): DocumentDTO;
}
