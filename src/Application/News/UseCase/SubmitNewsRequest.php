<?php
declare(strict_types=1);

namespace App\Application\News\UseCase;

class SubmitNewsRequest
{
    public function __construct(
        public readonly string $url
    )
    {

    }

}
