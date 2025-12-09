<?php

namespace App\Domain\ValueObject;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;

class Title
{
    private string $title;
    public function __construct(string $title)
    {
        $this->assertValidContent($title);
        $this->title = $title;
    }

    public function getValue(): string
    {
        return $this->title;
    }

    private function assertValidContent(string $content)
    {
        if (empty($content)) {
            throw new InvalidArgumentException("Title cannot be empty");
        }
    }
}
