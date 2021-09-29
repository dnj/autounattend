<?php

namespace dnj\Autounattend\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Order
{
    /**
     * @var string[]
     */
    protected array $fields;

    public function __construct(string ...$fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return string[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
