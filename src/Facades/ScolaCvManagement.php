<?php

namespace Transave\ScolaCvManagement\Facades;

use Illuminate\Support\Facades\Facade;

class ScolaCvManagement extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'scola-cv-management';
    }
}
