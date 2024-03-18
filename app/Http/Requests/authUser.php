<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class authUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ];
    }
    
    public function failedValidation(Validator $validator){
        
        throw new HttpResponseException(response()->json([
            'SUCCESS' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }

    //Message de la condition posée
    public function messages(){
        return[
          'name.required' => 'Le nom doit être fourni',
          'email.required' => 'Email doit être fourni',
          'email.unique' => 'Email existe déjà',
          'password.required' => 'Le mot de passe doit être fourni'
        ];
    }
}