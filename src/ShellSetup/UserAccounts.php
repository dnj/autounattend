<?php

namespace dnj\Autounattend\ShellSetup;

use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\Password;

class UserAccounts implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the administrator password for the computer and whether it is hidden in the unattended installation answer file.
     */
    public ?Password $administratorPassword = null;
}
