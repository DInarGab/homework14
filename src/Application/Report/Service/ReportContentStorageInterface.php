<?php

declare(strict_types=1);

namespace App\Application\Report\Service;

interface ReportContentStorageInterface
{
    public function store(string $fileName, string $content): string;
}
