<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Domain\Service\ReportViewGeneratorInterface;
use App\Domain\ValueObject\HtmlContent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ReportGeneratorController extends AbstractController implements ReportViewGeneratorInterface
{
    public function generate(array $news): string
    {
        $html = $this->renderView("report.html.twig", ["news" => $news]);

        return $html;
    }
}
