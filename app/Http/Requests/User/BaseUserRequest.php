<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseUserRequest extends FormRequest
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const USER_TYPE_ID = 'user_type';
    public const POSITION_ID = 'position_id';
    public const DEPARTMENT_ID = 'department_id';
    public const IS_TIME_KEEPER = 'is_time_keeper';
    public const IS_IN_STATE = 'is_in_state';
    public const PASSWORD = 'password';
    const RATE_MAIN = 'rate.main';
    const RATE_ADDITIONAL = 'rate.additional';
    const RATE_HIRED = 'rate.hired';
}
