<?php
declare(strict_types=1);

namespace App\Domain\Report\Entity;

use App\Domain\ValueObject\FileName;
use App\Domain\ValueObject\HtmlContent;

class Report
{
    private ?string $filePath = null;
    public function __construct(
        private readonly HtmlContent $content,
        private readonly FileName $filename = new FileName(),
    )
    {

    }

    public function getContent(): HtmlContent
    {
        return $this->content;
    }

    public function getFilename(): FileName
    {
        return $this->filename;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}
