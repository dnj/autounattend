<?php

namespace dnj\Autounattend;

class Password implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the password.
     */
    public string $value;

    /**
     * Specifies whether the password is hidden in the unattended installation answer file.
     * Default value is true.
     */
    public ?bool $plainText = null;

    public function __construct(string $value, ?bool $plainText = null)
    {
        $this->value = $value;
        $this->plainText = $plainText;
    }
}
