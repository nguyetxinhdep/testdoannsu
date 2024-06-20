<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThongTinChamCong;
use Illuminate\Http\Request;

class ThongTinChamCongController extends Controller
{
    public function index()
    {
        $chamcongs = ThongTinChamCong::all();
        return view('admin.chamcong.List',[
            'title' => 'Danh sách Chấm công',
            'chamcongs' => $chamcongs
        ]);
    }
}
