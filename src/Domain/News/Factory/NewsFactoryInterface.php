<?php
declare(strict_types=1);

namespace App\Domain\News\Factory;


use App\Domain\News\Entity\News;

interface NewsFactoryInterface
{
    public function create(string $title, string $url, string $date): News;
}
