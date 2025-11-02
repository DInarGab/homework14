<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

class HtmlContent
{
    private string $value;

    public function __construct(string $value)
    {
        if ($value === '') {
            throw new InvalidArgumentException('HTML content cannot be empty.');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
