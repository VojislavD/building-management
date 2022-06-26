<?php

namespace App\Contracts\Actions;

interface CreatesAdmin
{
    public function __invoke(array $input): void;
}
