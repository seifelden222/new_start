<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'account_type' => ['required', 'in:'.implode(',', array_keys(User::accountTypes()))],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers(),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'الاسم يجب أن يحتوي على حروف فقط بدون أرقام أو رموز.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح بدومين معروف.',
            'account_type.required' => 'يرجى اختيار نوع الحساب قبل إنشاء الحساب.',
            'account_type.in' => 'نوع الحساب المختار غير صالح.',
        ];
    }
}
