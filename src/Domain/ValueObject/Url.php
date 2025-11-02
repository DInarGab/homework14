<?php

namespace App\Domain\ValueObject;


use Doctrine\ORM\Mapping\Column;
use InvalidArgumentException;

class Url
{

    #[Column(type: 'string', nullable: false)]
    private string $url;

    public function __construct(string $url)
    {
        $this->assertValid($url);
        $this->url = $url;
    }



    private function assertValid(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL');
        }
    }

    public function getValue(): string
    {
        return $this->url;
    }
}
