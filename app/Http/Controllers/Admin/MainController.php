<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HopDong;
use App\Models\NhanVien;
use App\Models\PhongBan;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
     public function index(){
        $tongSoHopDong = HopDong::count();
        $tongSoNhanVien = NhanVien::count();
        $tongSoPhongBan = PhongBan::count();
        
        return view('home',[
            'title' => 'Trang Quản Trị Admin',
            'tong_so_hop_dong' => $tongSoHopDong,
            'tong_so_nhan_vien' => $tongSoNhanVien,
            'tong_so_phong_ban' => $tongSoPhongBan,
        ]);
    }
}
