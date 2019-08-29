<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    
    public function rules(Request $request)
    {
        
        return [
            'name' => 'required|string|max:255',
            'email' =>  ['required','string','max:255',
                        Rule::unique('users')->ignore($request->user->id),
                        ],
            //'email' => 'required|email|unique:users,email,'.$this->get('id'),           
            'password' => 'required|string|min:6|confirmed',
            'tipo' => 'required|string|max:255',
            'cc' => 'required|string|max:15',
            'telefono' => 'required|string|max:10',
        ];
    }
}
