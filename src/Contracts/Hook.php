<?php

namespace Tobono\Hook\Contracts;

interface Hook
{

    public function dispatch(string $hook, $args = null);

    public function listen(string|array $hooks, $callback, $priority = 10, $argsCount = 2);

    public function exists(string $hook);

    public function getCallback(string $hook);

    public function remove(string $hook, $callback = null, $priority = 10);
}
