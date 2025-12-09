<?php
declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Entity\Report;
use App\Domain\Report\Repository\ReportRepositoryInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;

class ReportRepository implements ReportRepositoryInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir
    )
    {}
    private const PUBLIC_SAVE_FOLDER = 'public/report';

    public function save(Report $report): void
    {
        $projectDir = $this->projectDir;
        $filePath = $projectDir . DIRECTORY_SEPARATOR . self::PUBLIC_SAVE_FOLDER . DIRECTORY_SEPARATOR . $report->getFileName()->getValue() . ".html";
        $filesystem = new Filesystem();
        $filesystem->dumpFile($filePath, $report->getContent()->getValue());

        $reflectionClass = new \ReflectionClass($report);
        $reflectionProperty = $reflectionClass->getProperty('filePath');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($report, $filePath);

    }

    public function getReport(int $id): Report
    {
        // TODO: Implement getReport() method.
    }
}
