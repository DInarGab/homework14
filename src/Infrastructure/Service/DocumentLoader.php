<?php
declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\News\Factory\NewsFactory;
use App\Domain\News\Entity\News;
use App\Domain\News\Entity\NewsSource;
use App\Domain\Service\DocumentLoaderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DocumentLoader implements DocumentLoaderInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
    )
    {
    }
    public function fetch(NewsSource $newsSource, NewsFactory $newsFactory): News
    {
        $response = $this->client->request("GET", $newsSource->getUrl()->getValue());
        $title = $this->extractTitle($response->getContent());
        $news = $newsFactory->create($title, $newsSource->getUrl()->getValue());
        return $news;
    }

    /**
     * @param string $html
     * @return string
     * @throws \Exception
     */
    private function extractTitle(string $html): string
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $titleElements = $dom->getElementsByTagName('title');

        if ($titleElements->length > 0) {
            return trim($titleElements->item(0)->textContent);
        }

        $titleElements = $dom->getElementsByTagName('h1');
        if ($titleElements->length > 0) {
            return trim($titleElements->item(0)->textContent);
        }

        throw new \Exception("Cant Find Title or H1 element on page");

    }

}
