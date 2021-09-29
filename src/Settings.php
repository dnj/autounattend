<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Name;

class Settings implements \JsonSerializable
{
    use ExportTrait;

    #[Name('@pass')]
    public string $pass;

    /**
     * @var \JsonSerializable[]
     */
    #[Name('#')]
    public array $components;

    /**
     * @param \JsonSerializable[] $components
     */
    public function __construct(string $pass, array $components)
    {
        $this->pass = $pass;
        $this->components = $components;
    }
}
