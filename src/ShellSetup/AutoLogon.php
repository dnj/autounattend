<?php

namespace dnj\Autounattend\ShellSetup;

use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\Password;

class AutoLogon implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether the automatic logon process is enabled.
     * Default value is false.
     */
    public ?bool $enabled = null;

    /**
     * Specifies the number of times that the account has been used. LogonCount must be specified if AutoLogon is used.
     */
    public ?int $logonCount = null;

    /**
     * Specifies the domain of the account used for authentication.
     */
    public ?string $domain = null;

    /**
     * Specifies the password of the user account used for authentication.
     */
    public ?Password $password = null;

    /**
     * Specifies the user name of the account used for authentication.
     */
    public ?string $username = null;
}
