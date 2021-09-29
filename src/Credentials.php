<?php

namespace dnj\Autounattend;

class Credentials implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the domain of the account used for authentication.
     */
    public ?string $domain = null;

    /**
     * Specifies the password of the user account used for authentication.
     */
    public ?string $password = null;

    /**
     * Specifies the user name of the account used for authentication.
     */
    public ?string $username = null;
}
