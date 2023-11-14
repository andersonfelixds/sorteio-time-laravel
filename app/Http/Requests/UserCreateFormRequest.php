<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateFormRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }
}