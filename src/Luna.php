<?php

namespace Suomato;

use Suomato\Commands\MakeCustomPostType;
use Suomato\Commands\MakeCustomTaxonomy;
use Suomato\Commands\MakeRoute;
use Suomato\Commands\MakeShortcode;
use Suomato\Commands\MakeMenuPage;

class Luna
{
    public static $version = '1.3.0';

    public static function commands()
    {
        return [
            new MakeCustomPostType(),
            new MakeCustomTaxonomy(),
            new MakeRoute(),
            new MakeShortcode(),
            new MakeMenuPage(),
        ];
    }
}
