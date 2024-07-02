<?php

namespace Tobono\Hook\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use Tobono\Hook\FilterRepository;

/**
 * @method static FilterRepository dispatch(string $hook, $args = null)
 * @method static FilterRepository listen(string|array $hooks, Closure|string|array $callback, int $priority = 10, int $argsCount = 3)
 * @method static FilterRepository exists(string $hook)
 * @method static FilterRepository|false remove(string $hook, Closure|string $callback, int $priority = 10)
 * @method static FilterRepository getCallback(string $hook)
 *
 * @see ActionRepository
 */
class Filter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filter';
    }
}
