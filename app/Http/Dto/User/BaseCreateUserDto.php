<?php

namespace App\Http\Dto\User;

abstract class BaseCreateUserDto extends BaseUserDto
{
    public string $name;
    public string $email;
    public string $password;
    public int $user_type;
}
