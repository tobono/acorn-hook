<?php

namespace Tobono\Hook\Abstracts;

use Closure;
use Illuminate\Support\Str;
use Tobono\Hook\Contracts\Hook;

abstract class Repository implements Hook {

    protected array $hooks = [];

    public abstract static function getAddableFunctionName(): string;

    public abstract static function getRegistrableFunctionName(): string;

    public abstract static function getArrayableRegisterFunctionName(): string;

    public function dispatch( $hook, $args = null ): static {

        $registrable = is_array( $args )
            ? static::getArrayableRegisterFunctionName()
            : static::getRegistrableFunctionName();

        call_user_func_array( $registrable, [ $hook, $args ] );

        return $this;
    }

    public function listen( string|array $hooks, $callback, $priority = 10, $argsCount = 3 ): static {
        foreach ( (array) $hooks as $hook ) {
            $this->addHookEvent( $hook, $callback, $priority, $argsCount );
        }

        return $this;
    }

    public function exists( string $hook ): bool {
        return array_key_exists( $hook, $this->hooks );
    }

    public function remove( string $hook, $callback = null, $priority = 10 ): static {
        if ( is_null( $callback ) ) {
            if ( ! $callback = $this->getCallback( $hook ) ) {
                return $this;
            }

            list( $callback, $priority, $argsCount ) = $callback;

            unset( $this->hooks[ $hook ] );
        }

        remove_action( $hook, $callback, $priority );

        return $this;
    }

    public function getCallback( string $hook ) {
        if ( array_key_exists( $hook, $this->hooks ) ) {
            return $this->hooks[ $hook ];
        }

        return null;
    }

    protected function addHookEvent( string $hook, $callback, $priority, $argsCount ) {
        if ( $callback instanceof Closure || is_array( $callback ) ) {
            $this->addEventListener( $hook, $callback, $priority, $argsCount );
        } elseif ( is_string( $callback ) ) {
            if ( str_contains( $callback, '@' ) || class_exists( $callback ) ) {
                $callback = $this->addClassEvent( $hook, $callback, $priority, $argsCount );
            } else {
                $this->addEventListener( $hook, $callback, $priority, $argsCount );
            }
        }

        return $callback;
    }

    protected function addClassEvent( string $hook, $class, $priority, $argsCount ) {
        $callback = $this->buildClassEventCallback( $class, $hook );

        $this->addEventListener( $hook, $callback, $priority, $argsCount );

        return $callback;
    }

    protected function buildClassEventCallback( $class, $hook ) {
        list( $class, $method ) = $this->parseClassEvent( $class, $hook );

        return [ app( $class ), $method ];
    }

    protected function parseClassEvent( $class, $hook ) {
        if ( Str::contains( $class, '@' ) ) {
            return explode( '@', $class );
        }

        $method = Str::contains( $hook, '-' ) ? str_replace( '-', '_', $hook ) : $hook;

        return [ $class, $method ];
    }

    protected function addEventListener( string $name, $callback, $priority, $argsCount ): void {
        $this->hooks[ $name ] = [ $callback, $priority, $argsCount ];

        call_user_func_array( static::getAddableFunctionName(), [
            $name,
            $callback,
            $priority,
            $argsCount
        ] );

    }
}
