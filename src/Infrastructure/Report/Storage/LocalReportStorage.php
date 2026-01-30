<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Storage;

use App\Application\Report\Service\ReportContentStorageInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;

class LocalReportStorage implements ReportContentStorageInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
        #[Autowire('%reports_dir_name%')]
        private readonly string $reportsDirName
    ) {}

    public function store(string $fileName, string $content): string
    {
        $relativePath = DIRECTORY_SEPARATOR . $this->reportsDirName . DIRECTORY_SEPARATOR . $fileName . ".html";
        $absolutePath = $this->projectDir . DIRECTORY_SEPARATOR . 'public' . $relativePath;

        $filesystem = new Filesystem();
        $filesystem->dumpFile($absolutePath, $content);

        return $relativePath;
    }
}
