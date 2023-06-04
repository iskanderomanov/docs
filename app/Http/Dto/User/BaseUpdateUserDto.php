<?php

namespace App\Http\Dto\User;

abstract class BaseUpdateUserDto extends BaseUserDto
{
    public string $name;
    public string $email;
    public string $password;
    public int $user_type;
    public int $position_id;
}
