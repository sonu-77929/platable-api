<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Rules\ExpiryDateInFuture;
class FoodItemRequest extends FormRequest
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
            'description' => 'required|string',
            'expiry_date' => 'date_format:Y-m-d|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'donor_id' => 'required|exists:donors,id',
            'recipient_id' => 'exists:recipients,id',
        ];
    }
    public function messages()
    {
        return [
            'expiry_date.date_format' => 'The expiry date field must match the format Y-m-d.',
            'expiry_date.after_or_equal' => 'The expiry date field must be a date after or equal to today.',
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
