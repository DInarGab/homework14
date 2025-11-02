<?php
declare(strict_types=1);

namespace App\Application\Report\Factory;

use App\Domain\Report\Entity\Report;
use App\Domain\Report\Factory\ReportFactoryInterface;
use App\Domain\ValueObject\FileName;
use App\Domain\ValueObject\HtmlContent;

class ReportFactory implements ReportFactoryInterface
{

    public function create(string $content): Report
    {
        return new Report(
            new HtmlContent($content),
            new FileName()
        );
    }
}
