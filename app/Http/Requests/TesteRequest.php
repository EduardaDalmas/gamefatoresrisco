<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TesteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(){
        return [
            'name.min' => 'Preenche o minimo de 3',
            'name.required' => 'Preenche isso',
            'nasc' => 'tem que ser data'
        ];


    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:3|required',
            'nasc' => 'date'
        ];
    }
}
