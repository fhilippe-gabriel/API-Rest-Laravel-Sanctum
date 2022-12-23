<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\BaseController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', ProductController::class);

    // //GET
    // Route::get('/products', [ProductController::class, 'index'])->name('posts.index');
    // Route::get('/products/{id}', [ProductController::class, 'show'])->name('posts.show');

    // //POST
    // Route::post('/products', [ProductController::class, 'store'])->name('posts.store');

    // //PUT
    // Route::post('/products/up/{id}', [ProductController::class, 'update'])->name('posts.update');

    // //DELETE
    // Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('posts.destroy');
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
