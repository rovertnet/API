<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class createPosts extends FormRequest
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
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    
    public function failedValidation(Validator $validator){
        
        throw new HttpResponseException(response()->json([
            'SUCCESS' => false,
            'error' => true,
            'message' => 'erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }

    //Message de la condition posée
    public function messages(){
        return[
          'title.required' => 'Le titre doit être fourni'  
        ];
    }
}