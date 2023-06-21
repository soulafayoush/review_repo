<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\review\ReviewController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout']);;
Route::post('/login',[AuthController::class,'login'])->name('login');
<<<<<<< HEAD
Route::get('/user',[UserController::class,'desc']);
=======

>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a

Route::group([

  //'prefix' => 'products',
  //  'middleware' => ['auth:sanctum','throttle:60,1']
    'middleware' => ['auth:sanctum']
],function (){
    Route::match(['put', 'patch'], '/update-user/{id}',[UserController::class,'updateRoles']);
    Route::group([
        'middleware' => 'isadmin'
    ],function(){
        Route::post('/add-product',[ProductController::class,'store']);
        Route::match(['put', 'patch'], '/update-product/{id}',[ProductController::class,'update']);
        Route::delete( '/delete-product/{id}',[ProductController::class,'destroy']);
        Route::get('/u',[UserController::class,'getUsersByRole']);
    });

    Route::get('/all-products',[ProductController::class,'index']);
  //There is something wrong right here....i wish you discover it
    Route::get('/product/{letter}',[ProductController::class,'filterProductsByCategory']);
    Route::get('/product/{id}',[ProductController::class,'show']);
    Route::get('/all-users',[UserController::class,'index']);







});

<<<<<<< HEAD
Route::group([

    //'prefix' => 'products',
    //  'middleware' => ['auth:sanctum','throttle:60,1']
      'middleware' => ['auth:sanctum']
  ],function (){
=======

>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a

Route::get('/review',[ReviewController::class,'index']);
Route::post('/add-review',[ReviewController::class,'store']);
Route::match(['put', 'patch'], '/update-review/{id}',[ReviewController::class,'update']);
Route::delete( '/delete-product/{id}',[ReviewController::class,'destroy']);
<<<<<<< HEAD
Route::get('/productt/{product_id}',[ReviewController::class,'filterreviewByproduct']);
Route::get('/product/{$user_id}',[ReviewController::class,' filterreviewByuser']);


});
=======
Route::get('/product/{product_id}',[ReviewController::class,'filterreviewByproduct']);
Route::get('/product/{$user_id}',[ReviewController::class,' filterreviewByuser']);



>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a

