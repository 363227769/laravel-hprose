<?php

namespace fendui\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static add(string $string, \Closure $param)
 * @method static getMethods()
 */
class HproseRoute extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hprose.router';
    }
}