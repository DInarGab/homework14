<?php
declare(strict_types=1);

namespace App\Application\Report\UseCase;

class GenerateReportRequest
{
    public readonly array $newsId;

    public function __construct(string $newsId)
    {
        $this->newsId = empty($newsId) ? [] : explode(",", $newsId);
    }
}
