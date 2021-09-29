<?php

namespace dnj\Autounattend\Attributes;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY)]
class Counter
{
    protected string $name;
    protected int $start;

    public function __construct(string $name, int $start = 0)
    {
        $this->name = $name;
        $this->start = $start;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStart(): int
    {
        return $this->start;
    }
}
