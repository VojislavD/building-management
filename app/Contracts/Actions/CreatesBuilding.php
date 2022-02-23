<?php

namespace App\Contracts\Actions;

use App\Models\Company;

interface CreatesBuilding
{
    public function __invoke(Company $company,array $input): void;
}