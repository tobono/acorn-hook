<?php

namespace Tobono\Hook;

use Tobono\Hook\Abstracts\Repository;

class FilterRepository extends Repository
{
    public static function getAddableFunctionName(): string {
        return 'add_filter';
    }

    public static function getRegistrableFunctionName(): string {
        return 'apply_filters';
    }

    public static function getArrayableRegisterFunctionName(): string {
        return 'apply_filters_ref_array';
    }
}
