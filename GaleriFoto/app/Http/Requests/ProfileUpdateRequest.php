<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah digunakan. Silakan pilih yang lain.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$validator->errors()->has('username')) {
                $currentUsername = $this->user()->username;
                $newUsername = $this->input('username');

                if ($currentUsername === $newUsername) {
                    $validator->errors()->add('username', 'Username tidak boleh sama dengan yang sebelumnya.');
                }
            }
        });
    }
}
