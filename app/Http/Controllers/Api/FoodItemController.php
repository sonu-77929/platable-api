<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use App\Http\Resources\FoodItemResource;
use App\Http\Requests\FoodItemRequest;
use Illuminate\Validation\ValidationException;

class FoodItemController extends Controller
{
    public function index()
    {
        try {
            $foodItems = FoodItem::with('recipient')->get();
    
            if ($foodItems->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No food items found.',
                    'data' => [],
                ]);
            }
    
            $transformedFoodItems = FoodItemResource::collection($foodItems);
    
            return response()->json([
                'success' => true,
                'message' => 'Food items successfully retrieved.',
                'data' => $transformedFoodItems,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving food items.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {

        // Retrieve a specific food item
        $foodItem = FoodItem::findOrFail($id);
        return response()->json($foodItem);
    }

    public function store(FoodItemRequest $request)
    {
        try {
            $foodItem = FoodItem::create($request->all());
    
            return response()->json([
                'success' => true,
                'message' => 'Food Item successfully created.',
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
                'message' => 'An error occurred while creating the food item.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(FoodItemRequest $request, $id)
    {
       
        try {
            $foodItem = FoodItem::findOrFail($id);
    
            $foodItem->update($request->all());
    
            return response()->json([
                'success' => true,
                'message' => 'Food Item successfully updated.',
                'data' => $foodItem,
            ]);
        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->errors(),
            ], $e->status);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the food item.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $foodItem = FoodItem::find($id);
    
            if (!$foodItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Food Item not found.',
                ], 404);
            }
    
            $foodItem->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Food Item successfully deleted.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the food item.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function getItemsByDonor($donorId)
    {
        try {
            $foodItems = FoodItem::where('donor_id', $donorId)->get();

            if ($foodItems->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No food items found for the specified donor.',
                    'data' => [],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Food items successfully retrieved for the specified donor.',
                'data' => $foodItems,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving food items.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
}

