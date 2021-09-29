<?php

namespace dnj\Autounattend\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Pass
{
    /**
     * @var string[]
     */
    protected array $names;

    /**
     * @param string[]|string $names
     */
    public function __construct($names)
    {
        $this->names = (array) $names;
    }

    /**
     * @return string[]
     */
    public function getNames(): array
    {
        return $this->names;
    }
}
