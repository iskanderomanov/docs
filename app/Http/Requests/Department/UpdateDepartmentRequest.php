<?php

namespace App\Http\Requests\Department;

use Illuminate\Support\Facades\Auth;

class UpdateDepartmentRequest extends BaseDepartmentRequest
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
        ];
    }
}
