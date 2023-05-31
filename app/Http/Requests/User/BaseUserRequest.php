<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseUserRequest extends FormRequest
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const USER_TYPE_ID = 'user_type';
    public const POSITION_ID = 'position_id';
    public const PASSWORD = 'password';
}
