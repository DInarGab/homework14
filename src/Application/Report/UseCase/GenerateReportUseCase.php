<?php
declare(strict_types=1);

namespace App\Application\Report\UseCase;

use App\Domain\News\Repository\NewsRepositoryInterface;
use App\Domain\Report\Factory\ReportFactoryInterface;
use App\Domain\Report\Repository\ReportRepositoryInterface;
use App\Domain\Service\ReportViewGeneratorInterface;

class GenerateReportUseCase
{

    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private ReportRepositoryInterface $reportRepository,
        private ReportFactoryInterface $reportFactory,
        private ReportViewGeneratorInterface $reportViewGenerator
    )
    {

    }
    public function __invoke(GenerateReportRequest $request): GenerateReportResponse
    {
        $news = $this->newsRepository->findByIds($request->newsId);
        //Генерируем верстку файла (string? или отправлять Value Object в фабрику? или как лучше вообще это дело делать?)
        $htmlContent = $this->reportViewGenerator->generate($news);
        //Сохраняем файл на диск
        $report = $this->reportFactory->create($htmlContent);
        $this->reportRepository->save($report);
        return new GenerateReportResponse(
            $report->getFilePath()
        );
    }
}
