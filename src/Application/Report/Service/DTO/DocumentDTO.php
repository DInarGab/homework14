<?php

declare(strict_types=1);

namespace App\Application\Report\Service\DTO;

class DocumentDTO
{
    public function __construct(
        public string $title,
        public string $content,
    )
    {

    }
}
