<?php
declare(strict_types=1);

namespace App\Application\Report\Service;


use App\Application\News\DTO\NewsDTO;

interface ReportViewGeneratorInterface
{
    /**
     * @param array<NewsDTO> $news
     *
     * @return string
     */
    public function generate(array $news): string;
}
