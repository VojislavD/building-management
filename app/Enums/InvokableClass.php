<?php

namespace App\Enums;

use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Enum;

trait InvokableClass
{
    public function __invoke(): int|string
    {
        return $this->value;
    }

    public static function __callStatic($name, $arguments): int|string
    {
        return collect(static::cases())->firstWhere('name', $name)->value;
    }
}