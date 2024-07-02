<?php

namespace Tobono\Hook;

use Tobono\Hook\Abstracts\Repository;

class ActionRepository extends Repository
{
    public static function getAddableFunctionName(): string {
        return 'add_action';
    }

    public static function getRegistrableFunctionName(): string {
        return 'do_action';
    }

    public static function getArrayableRegisterFunctionName(): string {
        return 'do_action_ref_array';
    }
}
