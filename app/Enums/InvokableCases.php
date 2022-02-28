<?php

namespace App\Enums;

use Exception;

trait InvokableCases
{
    public function __invoke(): int|string
    {
        return $this->value;
    }

    public static function __callStatic(string $name, array $args): int|string|Exception
    {
        $cases = static::cases();

        foreach ($cases as $case) {
            if ($case->name === $name) {
                return $case->value;
            }
        }

        return throw new Exception("Undefined constant ".static::class."::$name");
    }
}