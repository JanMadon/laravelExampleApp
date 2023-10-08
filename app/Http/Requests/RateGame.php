<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateGame extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'gameId' => ['required', 'integer'],
            'rate' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'rate.min' => 'Ocena musi być większa lub równa :min',
            'rate.max' => 'Ocena nie może być wieksza od :max',
            'rate.integer' => 'Przekazana wartość musi być liczbą całkowitą!!!',
        ];
    }
}
