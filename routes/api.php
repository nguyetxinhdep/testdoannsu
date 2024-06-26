<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\api\NhanVienAPI;
use App\Http\Controllers\api\ProfileAPI;
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

// chưa xác thực
Route::get('/unauthenticated', function () {
    return abort(401,"Unauthenticated");
})->name('api.unauthenticated');

Route::post('/login',[AuthController::class, 'login']);
Route::post('/sendmailforgotapi', [LoginController::class, 'sendMailCofirmapi']); 

Route::middleware('auth:api')->group(function () {
    Route::post('/register',[AuthController::class, 'register']);

    Route::prefix('profile')->group(function(){
        // update ảnh cá nhân
        Route::post('editimage', [ProfileAPI::class, 'updateImage']);
        Route::post('editinfo', [ProfileAPI::class, 'updateinfo']); 
    });

    Route::prefix('employees')->group(function(){
        Route::get('/', [NhanVienAPI::class, 'indexapi']);
        Route::get('/search', [NhanVienAPI::class, 'searchByName']);
        Route::post('create', [NhanVienAPI::class, 'addapi']);
        Route::put('update/{MaNV}', [NhanVienAPI::class, 'updateapi']);
        Route::delete('delete/{id}', [NhanVienAPI::class, 'deleteapi']);
        Route::post('exportexcel', [NhanVienAPI::class, 'exportexcelapi']);
        Route::post('exportpdf', [NhanVienAPI::class, 'exportpdfapi']);  
    });
});

