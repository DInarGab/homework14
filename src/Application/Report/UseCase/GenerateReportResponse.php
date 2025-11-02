<?php
declare(strict_types=1);

namespace App\Application\Report\UseCase;

class GenerateReportResponse
{
    public function __construct(public string $filePath)
    {

    }

    public function asArray(): array
    {
        return [
            'filePath' => $this->filePath,
        ];
    }
}
