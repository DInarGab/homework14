<?php
declare(strict_types=1);

namespace App\Domain\Service;


interface ReportViewGeneratorInterface
{
    public function generate(array $news): string;
}
