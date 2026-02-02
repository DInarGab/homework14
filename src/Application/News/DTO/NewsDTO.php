<?php

declare(strict_types=1);

namespace App\Application\News\DTO;

use App\Domain\News\Entity\News;
use DateTimeImmutable;

class NewsDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $url,
        public readonly DateTimeImmutable $date,
    ) {
    }

    public static function fromEntity(News $news): self
    {
        return new self(
            $news->getId(),
            $news->getTitle()->getValue(),
            $news->getUrl()->getValue(),
            DateTimeImmutable::createFromMutable($news->getDate()),
        );
    }

    public function asArray(): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'url'   => $this->url,
            'date'  => $this->date->format('Y-m-d'),
        ];
    }
}
