<?php

namespace App\Entity;

class Binary
{
    protected string $binary;

    public function getBinary(): string
    {
        return $this->binary;
    }

    public function setBinary(string $binary): void
    {
        $this->binary = $binary;
    }

    public function __toString(): string
    {
        return $this->binary;
    }
}
