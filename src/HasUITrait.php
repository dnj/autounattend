<?php

namespace dnj\Autounattend;

trait HasUITrait
{
    /**
     * Specifies whether to show the disk configuration UI in Windows Setup.
     */
    public ?string $willShowUI = null;
}
