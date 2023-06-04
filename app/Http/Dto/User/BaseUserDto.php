<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

abstract class BaseUserDto extends BaseDto
{
    public ?int $id;
}
