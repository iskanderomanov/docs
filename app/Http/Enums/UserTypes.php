<?php

namespace App\Http\Enums;

enum UserTypes: int
{
    case HR_TYPE = 1;
    case TIME_KEEPER_TYPE = 2;
    case ACCOUNTING_TYPE = 3;
    case TEACHER_TYPE = 4;
}
