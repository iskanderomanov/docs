<?php

namespace App\Http\Dto\User;

abstract class BaseCreateUserDto extends BaseUserDto
{
    public string $name;
    public string $email;
    public string $password;
    public int $user_type;
    public ?int $position_id;
    public ?int $department_id;
    public ?bool $is_time_keeper;
    public ?bool $is_in_state;

    public ?array $rate;
}
