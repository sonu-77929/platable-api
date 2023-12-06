<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonorRequest;
use App\Http\Requests\RecipientRequest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use App\Http\Resources\FoodItemResource;
use App\Http\Requests\FoodItemRequest;
use Illuminate\Validation\ValidationException;

class RecipientController extends Controller
{

    public function store(RecipientRequest $request)
    {
        try {
            $foodItem = Recipient::create($request->all());
    
            return response()->json([
                'success' => true,
                'message' => 'Recipient  successfully created.',
                'data' => $foodItem,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->errors(),
            ], $e->status);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the recipient.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

}

