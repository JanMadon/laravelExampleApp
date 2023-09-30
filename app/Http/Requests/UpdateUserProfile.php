<?php

//php artisan make:request UpdateUserProfile

namespace App\Http\Requests;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool // czy uzytkownik ma prawo wykonać akcje na jakiś zasobach.
    {   // zwracamy true poniewaz uzytkownik romi edit na sowich własnych zasobach, 
        // autentykacja przy logowaniu jest tu wyznacznikiem,
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array // tutaj umieszcamy warunki walidacji
    {
        //dd('rules');
        $userId = Auth::id();
        return [
            'email' => [
                'required',
                // 'unique:users',
                Rule::unique('users')->ignore($userId), // ignorowanie emial zalogowanego uzytkownika
                'email'
            ],
            'name' => [
                'required',
                'max:50',
                new AlphaSpaces(),
            ],
            'phone' => [
                'min:6'
            ],
            'avatar' => [
                'nullable',
                'file',
                'image'
            ],
            'avatar-clear' => [
                'nullable'
            ]

        ];
    }

    public function messages()
    {
        return [
            'email.unique' => ' Podany aders jest już zajęty!',
            'name.max' => ' Maxymalna ilość znaków to: :max' // :max jest tak jakby zmienną 
        ];
    }
}
