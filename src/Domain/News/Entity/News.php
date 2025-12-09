<?php

declare(strict_types=1);

namespace App\Domain\News\Entity;

use App\Domain\News\Repository\NewsRepository;
use App\Domain\ValueObject\Title;
use App\Domain\ValueObject\Url;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[ORM\Table(name: 'news')]
class News
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Embedded(class:Title::class)]
    private Title $title;

    #[ORM\Embedded(class:Url::class)]
    private Url $url;
    #[ORM\Column(type: 'date')]
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

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): News
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
