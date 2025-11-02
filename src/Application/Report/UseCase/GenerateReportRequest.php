<?php
declare(strict_types=1);

namespace App\Application\Report\UseCase;

class GenerateReportRequest
{
    /**
     * @param array<int> $newsId
     */
    public function __construct(public readonly array $newsId)
    {

    }
}
