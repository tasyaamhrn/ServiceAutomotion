<?php

use App\Http\Controllers\api\AuthController as ApiAuthController;
use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\CategoryController as ApiCategoryController;
use App\Http\Controllers\api\ComplaintController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\MemoController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CategoryController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('register/admin', [ApiAuthController::class, 'registerAdmin']);
Route::post('register/customer', [CustomerController::class, 'register']);
Route::post('login/admin', [ApiAuthController::class, 'loginAdmin']);
Route::post('login/customer', [CustomerController::class, 'login']);
Route::post('register/employee', [EmployeeController::class, 'register']);
Route::post('login/employee', [EmployeeController::class, 'login']);

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('department', [DepartmentController::class, 'index']);
    Route::get('logout', [CustomerController::class, 'logout']);
    Route::get('admin/logout', [ApiAuthController::class, 'logout']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    Route::post('customer/edit/{customer}', [CustomerController::class, 'update']);
    Route::get('category', [ApiCategoryController::class, 'index']);
    Route::post('category/add', [ApiCategoryController::class, 'add']);
    Route::post('category/edit/{category}', [ApiCategoryController::class, 'update']);
    Route::delete('category/delete/{category}', [ApiCategoryController::class, 'delete']);
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::get('complaint', [ComplaintController::class, 'index']);
    Route::get('complaint/{id}', [ComplaintController::class, 'show']);
    Route::post('complaint/add', [ComplaintController::class, 'add']);
    Route::post('complaint/edit/{id}', [ComplaintController::class, 'feedback']);
    Route::post('memo/add', [MemoController::class, 'add']);
    Route::get('booking', [BookingController::class, 'index']);
    Route::post('booking/add', [BookingController::class, 'add']);
    Route::get('booking/{id}', [BookingController::class, 'show']);

});
