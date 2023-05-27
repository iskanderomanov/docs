<?php

namespace App\Http\Dto\Admin;

abstract class BaseCreateAdminDto extends BaseAdminDto
{
    public string $name;
    public string $email;
    public bool $is_admin;
    public string $password;
}
