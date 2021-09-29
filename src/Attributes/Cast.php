<?php

namespace dnj\Autounattend\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Cast
{
    protected string $target;

    public function __construct(string $target)
    {
        $this->target = $target;
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}
