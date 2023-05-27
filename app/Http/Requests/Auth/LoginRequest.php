<?php

namespace App\Http\Requests\Auth;

class LoginRequest extends BaseAuthRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            self::EMAIL => 'email|required',
            self::PASSWORD => 'required|string'
        ];
    }
}
