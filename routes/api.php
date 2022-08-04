<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CustomerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register/customer',[CustomerController::class,'register']); 
//Route::post('/login',[CustomerController::class,'login']); 
 
Route::group(['middleware'=>'auth:api'],function(){ 
    // Route::get('/departemen',[DepartementController::class,'index']); 
    // Route::post('/departemen',[DepartementController::class,'store']); 
    // Route::get('/departemen/{id}', [DepartementController::class, 'show']); 
    // Route::post('/departemen/edit/{departemen}',[DepartementController::class,'update']); 
    // Route::delete('/departemen/{id}',[DepartementController::class,'destroy']); 
    // Route::post('/category',[CategoryController::class,'store']); 
    // Route::get('/category',[CategoryController::class,'index']); 
    // Route::get('/category/{id}', [CategoryController::class, 'show']); 
    // Route::post('/category/edit/{category}',[CategoryController::class,'update']); 
    // Route::delete('/category/{id}',[CategoryController::class,'destroy']); 
 
});