<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Pizza_raw_materialController;
use App\Http\Controllers\Raw_materialController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Pizza_SizeController;
use App\Http\Controllers\Pizza_IngredientController;
use App\Http\Controllers\ExtraIngredientController;
use App\Http\Controllers\Order_extra_ingredientController;
use App\Http\Controllers\Order_PizzaController;
use App\Http\Controllers\OrderController;
use App\Models\Order_pizza;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rutas Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    //Rutas Clientes
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    //Rutas Empleados
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

    //Rutas Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');

    //Rutas Pizzas
    Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas.index');
    Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/pizzas/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
    Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
    Route::get('/pizzas/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');

    //Rutas Branches
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');

    //Rutas Ingredientes
    Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
    Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');

    //Rutas Materiales
    Route::get('/raw_materials', [Raw_materialController::class, 'index'])->name('raw_materials.index');
    Route::post('/raw_materials', [Raw_materialController::class, 'store'])->name('raw_materials.store');
    Route::get('/raw_materials/create', [Raw_materialController::class, 'create'])->name('raw_materials.create');
    Route::delete('/raw_materials/{raw_material}', [Raw_materialController::class, 'destroy'])->name('raw_materials.destroy');
    Route::put('/raw_materials/{raw_material}', [Raw_materialController::class, 'update'])->name('raw_materials.update');
    Route::get('/raw_materials/{raw_material}/edit', [Raw_materialController::class, 'edit'])->name('raw_materials.edit');

    //Rutas Compras
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');

    //Rutas Compras
    Route::get('/pizza_raw_materials', [Pizza_raw_materialController::class, 'index'])->name('pizza_raw_materials.index');
    Route::post('/pizza_raw_materials', [Pizza_raw_materialController::class, 'store'])->name('pizza_raw_materials.store');
    Route::get('/pizza_raw_materials/create', [Pizza_raw_materialController::class, 'create'])->name('pizza_raw_materials.create');
    Route::delete('/pizza_raw_materials/{pizza_raw_material}', [Pizza_raw_materialController::class, 'destroy'])->name('pizza_raw_materials.destroy');
    Route::put('/pizza_raw_materials/{pizza_raw_material}', [Pizza_raw_materialController::class, 'update'])->name('pizza_raw_materials.update');
    Route::get('/pizza_raw_materials/{pizza_raw_material}/edit', [Pizza_raw_materialController::class, 'edit'])->name('pizza_raw_materials.edit');

    //Rutas Tamaño Pizza
    Route::get('/pizza_sizes', [Pizza_SizeController::class, 'index'])->name('pizza_sizes.index');
    Route::post('/pizza_sizes', [Pizza_SizeController::class, 'store'])->name('pizza_sizes.store');
    Route::get('/pizza_sizes/create', [Pizza_SizeController::class, 'create'])->name('pizza_sizes.create');
    Route::delete('/pizza_sizes/{pizza_size}', [Pizza_SizeController::class, 'destroy'])->name('pizza_sizes.destroy');
    Route::put('/pizza_sizes/{id}', [Pizza_SizeController::class, 'update'])->name('pizza_sizes.update');
    Route::get('/pizza_sizes/{id}/edit', [Pizza_SizeController::class, 'edit'])->name('pizza_sizes.edit');

    //Rutas Pizza_Ingredients
    Route::get('/pizza_ingredients', [Pizza_IngredientController::class, 'index'])->name('pizza_ingredients.index');
    Route::post('/pizza_Ingredients', [Pizza_IngredientController::class, 'store'])->name('pizza_ingredients.store');
    Route::get('/pizza_Ingredients/create', [Pizza_IngredientController::class, 'create'])->name('pizza_ingredients.create');
    Route::delete('/pizza_Ingredients/{pizza_Ingredient}', [Pizza_IngredientController::class, 'destroy'])->name('pizza_ingredients.destroy');
    Route::put('/pizza_Ingredients/{pizza_Ingredient}', [Pizza_IngredientController::class, 'update'])->name('pizza_ingredients.update');
    Route::get('/pizza_Ingredients/{pizza_Ingredient}/edit', [Pizza_IngredientController::class, 'edit'])->name('pizza_ingredients.edit');

    //Rutas Ingrediente Extra
    Route::get('/extraingredient', [ExtraIngredientController::class, 'index'])->name('extraingredient.index');
    Route::get('/extraingredient/create', [ExtraIngredientController::class, 'create'])->name('extraingredient.create');
    Route::post('/extraingredient', [ExtraIngredientController::class, 'store'])->name('extraingredient.store');
    Route::get('/extraingredient/{id}/edit', [ExtraIngredientController::class, 'edit'])->name('extraingredient.edit'); 
    Route::put('/extraingredient/{id}', [ExtraIngredientController::class, 'update'])->name('extraingredient.update');
    Route::delete('/extraingredient/{id}', [ExtraIngredientController::class, 'destroy'])->name('extraingredient.destroy');

    //Rutas Ordenes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    //Rutas Ordenes Pizza
    Route::get('/order_pizzas', [Order_PizzaController::class, 'index'])->name('order_pizzas.index');
    Route::post('/order_pizzas', [Order_PizzaController::class, 'store'])->name('order_pizzas.store');
    Route::get('/order_pizzas/create', [Order_PizzaController::class, 'create'])->name('order_pizzas.create');
    Route::delete('/order_pizzas/{order_pizza}', [Order_PizzaController::class, 'destroy'])->name('order_pizzas.destroy');
    Route::put('/order_pizzas/{order_pizza}', [Order_PizzaController::class, 'update'])->name('order_pizzas.update');
    Route::get('/order_pizzas/{order_pizza}/edit', [Order_PizzaController::class, 'edit'])->name('order_pizzas.edit');

    //Rutas Extra Ingredient
    Route::get('/order_extra_ingredients', [Order_extra_ingredientController::class, 'index'])->name('order_extra_ingredients.index');
    Route::post('/order_extra_ingredients', [Order_extra_ingredientController::class, 'store'])->name('order_extra_ingredients.store');
    Route::get('/order_extra_ingredients/create', [Order_extra_ingredientController::class, 'create'])->name('order_extra_ingredients.create');
    Route::delete('/order_extra_ingredients/{order_extra_ingredient}', [Order_extra_ingredientController::class, 'destroy'])->name('order_extra_ingredients.destroy');
    Route::put('/order_extra_ingredients/{order_extra_ingredient}', [Order_extra_ingredientController::class, 'update'])->name('order_extra_ingredients.update');
    Route::get('/order_extra_ingredients/{order_extra_ingredient}/edit', [Order_extra_ingredientController::class, 'edit'])->name('order_extra_ingredients.edit');


});

require __DIR__ . '/auth.php';
