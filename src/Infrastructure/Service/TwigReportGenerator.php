<?php
declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Service\ReportViewGeneratorInterface;
use Twig\Environment;

class TwigReportGenerator implements ReportViewGeneratorInterface
{
    public function __construct(
        private Environment $twig,
    )
    {

    }

    public function generate(array $news): string
    {
        return $this->twig->render("report.html.twig", ["news" => $news]);
    }
}
