<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Position\BasePositionRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends BaseUserRequest
{
    const RATE_MAIN = 'rate.main';
    const RATE_ADDITIONAL = 'rate.additional';
    const RATE_HIRED = 'rate.hired';
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
            self::RATE_MAIN => 'nullable|float',
            self::RATE_HIRED => 'nullable|float',
            self::RATE_ADDITIONAL => 'nullable|float',
        ];
    }
}
