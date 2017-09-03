<?php

namespace Suomato;

use Suomato\Commands\MakeCustomPostType;
use Suomato\Commands\MakeRoute;

class Luna
{
    public static function commands()
    {
        return [
            new MakeCustomPostType(),
            new MakeRoute()
        ];
    }
}