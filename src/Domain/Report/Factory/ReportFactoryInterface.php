<?php
declare(strict_types=1);

namespace App\Domain\Report\Factory;

use App\Domain\Report\Entity\Report;

interface ReportFactoryInterface
{
    public function create(string $content): Report;
}
