<?php

namespace App\Enums;

enum CompanyStatus: int 
{
    use InvokableClass;
    
    case Active = 1;
    case Inactive = 2;
}