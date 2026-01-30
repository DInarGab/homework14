<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\News\Service\DocumentLoaderInterface;
use App\Application\Report\Service\DTO\DocumentDTO;
use App\Domain\ValueObject\NewsSource;
use App\Domain\ValueObject\Url;
use DOMDocument;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DocumentLoader implements DocumentLoaderInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
    ) {
    }

    public function fetch(Url $newsSource): DocumentDTO
    {
        $response = $this->client->request("GET", $newsSource->getValue());
        $title    = $this->extractTitle($response->getContent());

        return new DocumentDTO(
            $title,
            $response->getContent()
        );
    }

    /**
     * @param string $html
     *
     * @return string
     * @throws Exception
     */
    private function extractTitle(string $html): string
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $titleElements = $dom->getElementsByTagName('title');

        if ($titleElements->length > 0) {
            return trim($titleElements->item(0)->textContent);
        }

        $titleElements = $dom->getElementsByTagName('h1');
        if ($titleElements->length > 0) {
            return trim($titleElements->item(0)->textContent);
        }

        throw new Exception("Cant Find Title or H1 element on page");
    }

}
