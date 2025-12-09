<?php

declare(strict_types=1);

namespace App\Domain\News\Entity;

use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\Url;

class News
{

    private ?int $id = null;

    private Title $title;

    private Url $url;
    private \DateTime $date;

    public function __construct(Title $title, Url $url, \DateTime $date = new \DateTime())
    {
        $this->date = $date;
        $this->url = $url;
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): News
    {
        $this->date = $date;
        return $this;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function setTitle(Title $title): News
    {
        $this->title = $title;
        return $this;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function setUrl(Url $url): News
    {
        $this->url = $url;
        return $this;
    }
}
