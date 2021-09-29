<?php

namespace dnj\Autounattend\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Wrapper
{
    protected ?string $name;

    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
