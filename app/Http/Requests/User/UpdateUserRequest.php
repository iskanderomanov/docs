<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends BaseUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->isHr();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            self::NAME => 'string|required',
            self::PASSWORD => 'string|required',
            self::EMAIL => 'email|required',
            self::USER_TYPE_ID => 'required|integer',
            self::POSITION_ID => 'nullable|integer',
            self::DEPARTMENT_ID => 'nullable|integer',
            self::IS_TIME_KEEPER => 'nullable|string',
            self::IS_IN_STATE => 'nullable|string',
            self::RATE_MAIN => 'nullable|numeric',
            self::RATE_HIRED => 'nullable|numeric',
            self::RATE_ADDITIONAL => 'nullable|numeric',
        ];
    }

}
