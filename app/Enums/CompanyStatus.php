<?php

namespace App\Enums;

enum CompanyStatus: int
{
    use InvokableCases;

    case Active = 1;
    case Inactive = 2;
}
