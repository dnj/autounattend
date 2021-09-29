<?php

namespace dnj\Autounattend\MPSSVC;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

#[Attribute('wcm:action', 'add')]
#[Wrapper]
class FirewallGroup implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether a Windows Firewall group is active.
     * The default value is false.
     */
    public ?bool $active = null;

    /**
     * Specifies a Windows Firewall group by its ID.
     */
    public string $group;

    /**
     * Specifies a unique name that you can use to identify the Firewall group.
     */
    #[Name('@wcm:keyValue')]
    public string $key;

    /**
     * Specifies a Windows Firewall group profile.
     * The default value is domain.
     */
    public ?string $profile = null;

    public function __construct(string $group, string $key, ?string $profile = null, ?bool $active = null)
    {
        $this->group = $group;
        $this->key = $key;
        $this->profile = $profile;
        $this->active = $active;
    }
}
