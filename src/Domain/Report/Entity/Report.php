<?php

declare(strict_types=1);

namespace App\Domain\Report\Entity;


class Report
{
    private ?int $id = null;
    private \DateTimeImmutable $createdAt;

    public function __construct(
        private string $filePath,
    ) {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
