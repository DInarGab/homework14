<?php
declare(strict_types=1);

namespace App\Application\News\SubmitNewsUseCase;

class SubmitNewsResponse
{
    public function __construct(public readonly int $id)
    {

    }

    public function asArray(): array
    {
        return [
            "id" => $this->id,
        ];
    }
}
