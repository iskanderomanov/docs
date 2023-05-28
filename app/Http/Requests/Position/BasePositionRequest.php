<?php

namespace App\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

abstract class BasePositionRequest extends FormRequest
{
    public const NAME = 'name';
}
