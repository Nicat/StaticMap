<?php
namespace Nicat\StaticMap\Facade;

use Illuminate\Support\Facades\Facade;

class StaticMap extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'static-map';
    }

}