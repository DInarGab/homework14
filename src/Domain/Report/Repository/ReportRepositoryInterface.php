<?php
declare(strict_types=1);

namespace App\Domain\Report\Repository;

use App\Domain\Report\Entity\Report;

interface ReportRepositoryInterface
{
    public function save(Report $report): void;

    public function getReport(int $id): Report;

}
