<?php

declare(strict_types=1);

namespace App\Application\News\DTO;

class SubmitNewsRequest
{
    public function __construct(
        public readonly string $url
    ) {
    }

}
