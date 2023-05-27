<?php

namespace App\Http\Dto\Hr;

abstract class BaseCreateHrDto extends BaseHrDto
{
    public string $name;
    public string $email;
    public string $password;
}
