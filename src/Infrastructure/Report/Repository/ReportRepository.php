<?php
declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Entity\Report;
use App\Domain\Report\Repository\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{

    public function save(Report $report): void
    {
        // TODO: Implement save() method.
    }

    public function getReport(int $id): Report
    {
        // TODO: Implement getReport() method.
    }
}
