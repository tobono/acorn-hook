<?php

namespace Tobono\Hook\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use Tobono\Hook\ActionRepository;

/**
 * @method static ActionRepository dispatch(string $hook, $args = null)
 * @method static ActionRepository listen(string|array $hooks, Closure|string|array $callback, int $priority = 10, int $argsCount = 3)
 * @method static ActionRepository exists(string $hook)
 * @method static ActionRepository|false remove(string $hook, Closure|string $callback, int $priority = 10)
 * @method static ActionRepository getCallback(string $hook)
 *
 * @see ActionRepository
 */
class Action extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'action';
    }
}
