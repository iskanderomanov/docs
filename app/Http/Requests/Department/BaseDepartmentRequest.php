<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseDepartmentRequest extends FormRequest
{
    public const NAME = 'name';
}
