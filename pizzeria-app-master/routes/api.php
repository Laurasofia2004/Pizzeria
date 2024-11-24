<?php

use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\ExtraIngredientController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\Order_extra_ingredientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\api\Pizza_IngredientController;
use App\Http\Controllers\api\Pizza_SizeController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\Order_PizzaController;
use App\Http\Controllers\Api\Pizza_raw_materialController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\Raw_materialController;
use App\Http\Controllers\api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('pizzas', PizzaController::class);
Route::apiResource('pizza_size', Pizza_SizeController::class);
Route::apiResource('ingredients', IngredientController::class);
Route::apiResource('pizza_ingredient', Pizza_IngredientController::class);
Route::apiResource('extra_ingredients', ExtraIngredientController::class);
Route::apiResource('branches', BranchController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('order_pizza', Order_PizzaController::class);
Route::apiResource('order_extra_ingredient', Order_extra_ingredientController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('raw_materials', Raw_materialController::class);
Route::apiResource('purchases', PurchaseController::class);
Route::apiResource('pizza_raw_material', Pizza_raw_materialController::class);


