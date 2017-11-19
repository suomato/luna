<?php

namespace Suomato;

use Suomato\Commands\MakeCustomPostType;
use Suomato\Commands\MakeRoute;
use Suomato\Commands\MakeShortcode;

class Luna
{
    public static $version = '1.1.2';

    public static function commands()
    {
        return [
            new MakeCustomPostType(),
            new MakeRoute(),
            new MakeShortcode(),
        ];
    }
}
