<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class FileName
{
    private readonly string $fileName;
    private const FILE_PREFIX = "report_";

    public function __construct()
    {
        if (empty($value)) {
            throw new InvalidArgumentException("Filename cannot be empty");
        }
    }

    public function getValue(): string
    {
        return $this->fileName;
    }

    public static function generate(): self
    {
        $name = self::FILE_PREFIX . date("Y-m-d-H-i-s");

        return new self($name);
    }

}
