<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiaryRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:120',
            'description'=> 'required', 
            'start_at'=> 'nullable|date', 
            'deadline_at'=> 'nullable|date', 
            'conclusion_at'=>'nullable|date'
        ];
    }
}
