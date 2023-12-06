<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Rules\ExpiryDateInFuture;
class RecipientRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'contact_information' => 'required',
        ];
    }
 
    protected function failedValidation(Validator $validator)
    {
        // dd($validator->errors());
        throw new HttpResponseException(
            response()->json([
                'statusCode' => 400,
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors(),
            ])
        );
    }
}
