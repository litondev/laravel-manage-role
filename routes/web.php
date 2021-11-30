<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    InventoryController, 
    ProductController
};
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login",function(){
    if(auth()->attempt(["email" => "admin@gmail.com","password" => "12345678"])){
        return response()->json([
            "message" => "Success Login"
        ],200);
    }

    return response()->json([
        "message" => "Failed Login"
    ],401);
});

Route::get("/logout",function(){
    auth()->logout();
    return response()->json([
        "message" => "Success"
    ]);
});

Route::resource("user",UserController::class)->middleware("role:user");
Route::resource("inventory",InventoryController::class)->middleware(["role:inventory","role_inventory"]);
Route::resource("product",ProductController::class)->middleware(["role:product","role_product"]);
