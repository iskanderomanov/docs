<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseAuthRequest extends FormRequest
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
}
