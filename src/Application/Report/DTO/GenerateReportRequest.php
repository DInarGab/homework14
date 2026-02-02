<?php
declare(strict_types=1);

namespace App\Application\Report\DTO;

class GenerateReportRequest
{
    public readonly array $newsIds;

    public function __construct(string $newsIds)
    {
        $this->newsIds = empty($newsIds) ? [] : explode(",", $newsIds);
    }
}
