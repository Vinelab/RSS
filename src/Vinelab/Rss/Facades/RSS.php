<?php

namespace Vinelab\Rss\Facades;

use Illuminate\Support\Facades\Facade;

class RSS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vinelab.rss';
    }
}
