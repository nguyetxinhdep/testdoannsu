<?php

use App\Http\Controllers\Admin\BaoHiemCotroller;
use App\Http\Controllers\Admin\ChiTietPhuTroiController;
use App\Http\Controllers\Admin\ChiTietQuyetDinhChucVuController;
use App\Http\Controllers\Admin\ChucVuController;
use App\Http\Controllers\Admin\HopDongController;
use App\Http\Controllers\Admin\LoaiHopDongController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\NhanVienController;
use App\Http\Controllers\Admin\PhieuGhiPhuTroiController;
use App\Http\Controllers\Admin\PhongBanController;
use App\Http\Controllers\Admin\PhuCap_LuongController;
use App\Http\Controllers\Admin\PhuCapController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuyetDinhChucVuController;
use App\Http\Controllers\Admin\QuyetDinhLuongController;
use App\Http\Controllers\Admin\SoBaoHiemCotroller;
use App\Http\Controllers\Admin\ThongTinChamCongController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\KhenThuong_KyLuatCaNhanController;
use App\Http\Controllers\KhenThuong_KyLuatTapTheController;
use App\Http\Controllers\QuyetDinhKhenThuong_KyLuatController;
use App\Http\Controllers\QuyetDinhTuyenDungController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('admin/login', [LoginController::class, 'index'])->name('login'); //đặt tên route là login cho thuận tiện
Route::post('admin/login/store', [LoginController::class, 'store']); 
Route::get('admin/logout', [LoginController::class, 'logout'])->name('logout');
 //đặt tên route là logout cho thuận tiện

//  lấy lại mật khẩu
Route::get('/forgot-password', [LoginController::class, 'forgotPass'])->name('forgot-password'); 
Route::post('/sendmailforgot', [LoginController::class, 'sendMailCofirm']); 
Route::get('/yeucauthanhcong', function () {
    return view('emails.yeucauthanhcong'); // Trả về view 'yeucauthanhcong'
})->name('yeucauthanhcong');
Route::get('xacnhan/{id}/{token}', [LoginController::class, 'accept'])->name('xacnhan'); 
Route::post('doimatkhau/{id}', [LoginController::class, 'changPass'])->name('doimatkhau'); 
//end lấy lại mật khẩu

// profile
Route::get('profile', [ProfileController::class, 'index']); 
Route::get('profile/edit', [ProfileController::class, 'edit']); 
Route::post('profile/edit', [ProfileController::class, 'update']); 
Route::get('profile/editpass', [ProfileController::class, 'editPass']); 
Route::post('profile/editpass', [ProfileController::class, 'authPass']); 
Route::get('/profile/editimage', [ProfileController::class, 'changImage']);
Route::post('/profile/editimage', [ProfileController::class, 'updateImage']);
// Route::get('profile/test/edit', [ProfileController::class, 'update']); 



Route::middleware(['auth','rule.user'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    // Route::get('/chat', function (){
    //     return view('chat.view');
    // });
    Route::get('/chat', [ChatController::class, 'chatShow'])->name('chat.show');
    Route::post('/chat/message', [ChatController::class, 'messageReceived']);
    // Route::post('/chat/message/send',[ChatController::class,'store']);

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #employ
        Route::prefix('employ')->group(function () {
            Route::get('add',[NhanVienController::class,'create']);
            Route::post('add',[NhanVienController::class,'store']);

            Route::get('List',[NhanVienController::class,'index']);
            Route::get('List/export',[NhanVienController::class,'export']);//Excel
            Route::get('List/export-pdf',[NhanVienController::class,'exportPDF']);//PDF

            Route::DELETE('delete/{id}',[NhanVienController::class,'destroy']);

            Route::get('edit/{id}',[NhanVienController::class,'edit']);
            Route::post('edit',[NhanVienController::class,'update']);

        });

        #OT (phụ trội)
        Route::prefix('OT')->group(function () {
            // phiếu ghi phụ trội
            Route::get('phieu',[PhieuGhiPhuTroiController::class,'index']);
            Route::get('phieu/add',[PhieuGhiPhuTroiController::class,'create']);
            Route::post('phieu/add',[PhieuGhiPhuTroiController::class,'store']);

            Route::DELETE('delete/{id}',[PhieuGhiPhuTroiController::class,'destroy']);

            Route::get('edit/{id}',[PhieuGhiPhuTroiController::class,'edit']);
            Route::post('edit',[PhieuGhiPhuTroiController::class,'update']);

            // chi tiết phụ trội
            Route::get('chitiet',[ChiTietPhuTroiController::class,'index']);
            Route::get('chitiet/add',[ChiTietPhuTroiController::class,'create']);
            Route::post('chitiet/add',[ChiTietPhuTroiController::class,'store']);

            Route::DELETE('chitiet/delete/{id}',[ChiTietPhuTroiController::class,'destroy']);

            Route::get('/chitiet/edit/{id}',[ChiTietPhuTroiController::class,'edit']);
            Route::post('/chitiet/edit',[ChiTietPhuTroiController::class,'update']);

            // Route::get('edit/chitiet/{id}',[ChiTietPhuTroiController::class,'edit']);
            // Route::post('edit/chitiet',[ChiTietPhuTroiController::class,'update']);
        });

        #quyết định tuyển dụng/ hiring decicions
        Route::prefix('hiring')->group(function () {
            Route::get('add',[QuyetDinhTuyenDungController::class,'create']);
            Route::post('add',[QuyetDinhTuyenDungController::class,'store']);

            Route::get('List',[QuyetDinhTuyenDungController::class,'index']);
            Route::get('List/export',[QuyetDinhTuyenDungController::class,'export']);//Excel
            Route::get('List/export-pdf',[QuyetDinhTuyenDungController::class,'exportPDF']);//PDF

            Route::DELETE('delete/{id}',[QuyetDinhTuyenDungController::class,'destroy']);

            Route::get('edit/{id}',[QuyetDinhTuyenDungController::class,'edit']);
            Route::post('edit',[QuyetDinhTuyenDungController::class,'update']);

        });

        #quyết định tuyển dụng/ hiring decicions
        Route::prefix('reward-discipline')->group(function () {
            Route::prefix('decide')->group(function () {
                Route::get('add',[QuyetDinhKhenThuong_KyLuatController::class,'create']);
                Route::post('add',[QuyetDinhKhenThuong_KyLuatController::class,'store']);
    
                Route::get('List',[QuyetDinhKhenThuong_KyLuatController::class,'index']);
                Route::get('/',[QuyetDinhKhenThuong_KyLuatController::class,'index']);
                Route::get('List/export',[QuyetDinhKhenThuong_KyLuatController::class,'export']);//Excel
                Route::get('List/export-pdf',[QuyetDinhKhenThuong_KyLuatController::class,'exportPDF']);//PDF
    
                Route::DELETE('delete/{id}',[QuyetDinhKhenThuong_KyLuatController::class,'destroy']);
    
                Route::get('edit/{id}',[QuyetDinhKhenThuong_KyLuatController::class,'edit']);
                Route::post('edit',[QuyetDinhKhenThuong_KyLuatController::class,'update']);
            });

            Route::prefix('individual')->group(function () {
                Route::get('add',[KhenThuong_KyLuatCaNhanController::class,'create']);
                Route::post('add',[KhenThuong_KyLuatCaNhanController::class,'store']);
    
                Route::get('List',[KhenThuong_KyLuatCaNhanController::class,'index']);
                Route::get('/',[KhenThuong_KyLuatCaNhanController::class,'index']);
                // Route::get('List/export',[KhenThuong_KyLuatCaNhanController::class,'export']);//Excel
                // Route::get('List/export-pdf',[KhenThuong_KyLuatCaNhanController::class,'exportPDF']);//PDF
    
                Route::DELETE('delete/{id}',[KhenThuong_KyLuatCaNhanController::class,'destroy']);
    
                Route::get('edit/{id}',[KhenThuong_KyLuatCaNhanController::class,'edit']);
                Route::post('edit',[KhenThuong_KyLuatCaNhanController::class,'update']);                
            });

            Route::prefix('collective')->group(function () {
                Route::get('add',[KhenThuong_KyLuatTapTheController::class,'create']);
                Route::post('add',[KhenThuong_KyLuatTapTheController::class,'store']);
    
                Route::get('List',[KhenThuong_KyLuatTapTheController::class,'index']);
                Route::get('/',[KhenThuong_KyLuatTapTheController::class,'index']);
                // Route::get('List/export',[KhenThuong_KyLuatTapTheController::class,'export']);//Excel
                // Route::get('List/export-pdf',[KhenThuong_KyLuatTapTheController::class,'exportPDF']);//PDF
    
                Route::DELETE('delete/{id}',[KhenThuong_KyLuatTapTheController::class,'destroy']);
    
                Route::get('edit/{id}',[KhenThuong_KyLuatTapTheController::class,'edit']);
                Route::post('edit',[KhenThuong_KyLuatTapTheController::class,'update']);        
            });

        });

        #department
        Route::prefix('department')->group(function () {
            Route::get('add',[PhongBanController::class,'create']);
            Route::post('add',[PhongBanController::class,'store']);

            Route::get('List',[PhongBanController::class,'index']);

            Route::DELETE('delete/{id}',[PhongBanController::class,'destroy']);

            Route::get('edit/{id}',[PhongBanController::class,'edit']);
            Route::post('edit',[PhongBanController::class,'update']);
        });

        #contract-type
        Route::prefix('contract-type')->group(function () {
            Route::get('add',[LoaiHopDongController::class,'create']);
            Route::post('add',[LoaiHopDongController::class,'store']);

            Route::get('List',[LoaiHopDongController::class,'index']);
            Route::get('/',[LoaiHopDongController::class,'index']);

            Route::DELETE('delete/{id}',[LoaiHopDongController::class,'destroy']);

            Route::get('edit/{id}',[LoaiHopDongController::class,'edit']);
            Route::post('edit',[LoaiHopDongController::class,'update']);
        });

        #contract
        Route::prefix('contract')->group(function () {
            Route::get('add',[HopDongController::class,'create']);
            Route::post('add',[HopDongController::class,'store']);

            Route::get('List',[HopDongController::class,'index']);
            Route::get('/',[HopDongController::class,'index']);

            Route::DELETE('delete/{id}',[HopDongController::class,'destroy']);

            Route::get('edit/{id}',[HopDongController::class,'edit']);
            Route::post('edit',[HopDongController::class,'update']);
        });

        #insurance
        Route::prefix('insurance')->group(function () {
            Route::get('add',[BaoHiemCotroller::class,'create']);
            Route::post('add',[BaoHiemCotroller::class,'store']);

            Route::get('List',[BaoHiemCotroller::class,'index']);
            Route::get('/',[BaoHiemCotroller::class,'index']);

            Route::DELETE('delete/{id}',[BaoHiemCotroller::class,'destroy']);

            Route::get('edit/{id}',[BaoHiemCotroller::class,'edit']);
            Route::post('edit',[BaoHiemCotroller::class,'update']);
        });

        #insurance-book
        Route::prefix('insurance-book')->group(function () {
            Route::get('add',[SoBaoHiemCotroller::class,'create']);
            Route::post('add',[SoBaoHiemCotroller::class,'store']);

            Route::get('List',[SoBaoHiemCotroller::class,'index']);
            Route::get('/',[SoBaoHiemCotroller::class,'index']);

            Route::DELETE('delete/{id}',[SoBaoHiemCotroller::class,'destroy']);

            Route::get('edit/{id}',[SoBaoHiemCotroller::class,'edit']);
            Route::post('edit',[SoBaoHiemCotroller::class,'update']);
        });

        #allowance-trợ cấp
        Route::prefix('allowance')->group(function () {
            Route::get('add',[PhuCapController::class,'create']);
            Route::post('add',[PhuCapController::class,'store']);

            Route::get('List',[PhuCapController::class,'index']);
            Route::get('/',[PhuCapController::class,'index']);

            Route::DELETE('delete/{id}',[PhuCapController::class,'destroy']);

            Route::get('edit/{id}',[PhuCapController::class,'edit']);
            Route::post('edit',[PhuCapController::class,'update']);
        });

        #salary-decision-quyết định lương
        Route::prefix('salary-decision')->group(function () {
            Route::get('add',[QuyetDinhLuongController::class,'create']);
            Route::post('add',[QuyetDinhLuongController::class,'store']);

            Route::get('List',[QuyetDinhLuongController::class,'index']);
            Route::get('/',[QuyetDinhLuongController::class,'index']);

            Route::DELETE('delete/{id}',[QuyetDinhLuongController::class,'destroy']);

            Route::get('edit/{id}',[QuyetDinhLuongController::class,'edit']);
            Route::post('edit',[QuyetDinhLuongController::class,'update']);
        });

        #salary-allowance-trợ cấp lương
        Route::prefix('salary_allowance')->group(function () {
            Route::get('add',[PhuCap_LuongController::class,'create']);
            Route::post('add',[PhuCap_LuongController::class,'store']);

            Route::get('List',[PhuCap_LuongController::class,'index']);
            Route::get('/',[PhuCap_LuongController::class,'index']);

            Route::DELETE('delete/{id}',[PhuCap_LuongController::class,'destroy']);

            Route::get('edit/{id}',[PhuCap_LuongController::class,'edit']);
            Route::post('edit',[PhuCap_LuongController::class,'update']);
        });

        #position
        Route::prefix('position')->group(function () {
            Route::get('add',[ChucVuController::class,'create']);
            Route::post('add',[ChucVuController::class,'store']);

            Route::get('List',[ChucVuController::class,'index']);
            Route::get('/',[ChucVuController::class,'index']);

            Route::DELETE('delete/{id}',[ChucVuController::class,'destroy']);

            Route::get('edit/{id}',[ChucVuController::class,'edit']);
            Route::post('edit',[ChucVuController::class,'update']);
        });

        #position-decision
        Route::prefix('position-decision')->group(function () {
            Route::get('add',[QuyetDinhChucVuController::class,'create']);
            Route::post('add',[QuyetDinhChucVuController::class,'store']);

            Route::get('List',[QuyetDinhChucVuController::class,'index']);
            Route::get('/',[QuyetDinhChucVuController::class,'index']);

            Route::DELETE('delete/{id}',[QuyetDinhChucVuController::class,'destroy']);

            Route::get('edit/{id}',[QuyetDinhChucVuController::class,'edit']);
            Route::post('edit',[QuyetDinhChucVuController::class,'update']);
        });

        #position-detail
        Route::prefix('position-detail')->group(function () {
            Route::get('add',[ChiTietQuyetDinhChucVuController::class,'create']);
            Route::post('add',[ChiTietQuyetDinhChucVuController::class,'store']);

            Route::get('List',[ChiTietQuyetDinhChucVuController::class,'index']);
            Route::get('/',[ChiTietQuyetDinhChucVuController::class,'index']);

            Route::DELETE('delete/{id}',[ChiTietQuyetDinhChucVuController::class,'destroy']);

            Route::get('edit/{id}',[ChiTietQuyetDinhChucVuController::class,'edit']);
            Route::post('edit',[ChiTietQuyetDinhChucVuController::class,'update']);
        });

        #time-keeping
        Route::prefix('timekeeping')->group(function () {
            // Route::get('add',[ChiTietQuyetDinhChucVuController::class,'create']);
            // Route::post('add',[ChiTietQuyetDinhChucVuController::class,'store']);

            Route::get('List',[ThongTinChamCongController::class,'index']);
            Route::get('/',[ThongTinChamCongController::class,'index']);

            // Route::DELETE('delete/{id}',[ChiTietQuyetDinhChucVuController::class,'destroy']);

            // Route::get('edit/{id}',[ChiTietQuyetDinhChucVuController::class,'edit']);
            // Route::post('edit',[ChiTietQuyetDinhChucVuController::class,'update']);
        });

        #products
        // Route::prefix('products')->group(function () {
        //     Route::get('add',[ProductController::class,'create']);
        // });

        #upload
        // Route::post('upload/services', [UploadController::class,'store']);
    });
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
