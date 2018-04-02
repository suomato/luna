<?php

namespace Suomato;

use Suomato\Commands\MakeCustomPostType;
use Suomato\Commands\MakeRoute;
use Suomato\Commands\MakeShortcode;
use Suomato\Commands\MakeMenuPage;

class Luna
{
    public static $version = '1.2.0';

    public static function commands()
    {
        return [
            new MakeCustomPostType(),
            new MakeRoute(),
            new MakeShortcode(),
            new MakeMenuPage(),
        ];
    }
}
