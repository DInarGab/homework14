<?php
declare(strict_types=1);

namespace App\Application\Report\UseCase;

use App\Application\Report\Service\ReportContentStorageInterface;
use App\Application\Report\Service\ReportViewGeneratorInterface;
use App\Domain\News\Repository\NewsRepositoryInterface;
use App\Domain\Report\Factory\ReportFactoryInterface;
use App\Domain\Report\Repository\ReportRepositoryInterface;

class GenerateReportUseCase
{

    public function __construct(
        private NewsRepositoryInterface      $newsRepository,
        private ReportRepositoryInterface    $reportRepository,
        private ReportFactoryInterface       $reportFactory,
        private ReportViewGeneratorInterface $reportViewGenerator,
        private ReportContentStorageInterface $reportContentStorage
    )
    {

    }

    public function __invoke(GenerateReportRequest $request): GenerateReportResponse
    {
        $news = $this->newsRepository->getByIds($request->newsIds);
        if (empty($news)) {
            throw new \InvalidArgumentException('No News with supplied ids: ' . implode(',', $request->newsIds));
        }


        $htmlContent = $this->reportViewGenerator->generate($news);

        $fileName = 'report_' . date('Y-m-d_H-i-s');
        $filePath = $this->reportContentStorage->store($fileName, $htmlContent);
        //Сохраняем ссылку на отчет в БД
        $report = $this->reportFactory->create($filePath);
        $this->reportRepository->save($report);
        return new GenerateReportResponse(
            $report->getFilePath()
        );
    }
}
