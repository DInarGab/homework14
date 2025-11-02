<?php
declare(strict_types=1);

namespace App\Application\News\Factory;


use App\Domain\News\Entity\News;
use App\Domain\News\Factory\NewsFactoryInterface;
use App\Domain\ValueObject\Url;

class NewsFactory implements NewsFactoryInterface
{
    public function create(string $title, string $url, ?string $date): News
    {

        return new News(new Title($title), new Url($url), new \DateTimeImmutable($date));
    }
}
