<?php

namespace dnj\Autounattend;

class Command implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the credentials to use when accessing paths.
     */
    public ?Credentials $credentials = null;

    /**
     * Specifies a description of the command to run.
     */
    public ?string $description = null;

    /**
     * Specifies the path to the command to run.
     */
    public string $path;

    /**
     * Specifies the user name of the account used for authentication.
     */
    public ?string $willReboot = null;

    public function __construct(string $path, ?string $description = null)
    {
        $this->path = $path;
        $this->description = $description;
    }
}
