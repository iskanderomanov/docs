<?php

namespace App\Http\Dto\Auth;

class BaseLoginAuthDto extends BaseAuthDto
{
    /**
     * @var string
     */
    public string $email;
    /**
     * @var string
     */
    public string $password;
}
