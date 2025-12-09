<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

class FileName
{
    private readonly string $fileName;
    private const FILE_PREFIX = "report_";
    public function __construct()
    {
        $this->fileName = self::FILE_PREFIX . date("Y-m-d-H-i-s");
    }

    public function getValue(): string
    {
        return $this->fileName;
    }

}
