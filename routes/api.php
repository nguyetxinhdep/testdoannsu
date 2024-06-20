<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NhanVienController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/sendmailforgotapi', [LoginController::class, 'sendMailCofirmapi']); 

Route::middleware('auth:api')->group(function () {
    Route::prefix('employees')->group(function(){
        Route::get('/', [NhanVienController::class, 'indexapi']);
        Route::post('create', [NhanVienController::class, 'addapi']);
        Route::put('update/{MaNV}', [NhanVienController::class, 'updateapi']);
        Route::delete('delete/{id}', [NhanVienController::class, 'deleteapi']);
        Route::post('exportexcel', [NhanVienController::class, 'exportexcelapi']);
        Route::post('exportpdf', [NhanVienController::class, 'exportpdfapi']);
    });
});

