<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhongBan;
use Illuminate\Http\Request;

class PhongBanController extends Controller
{
    //
    public function index()
    {
        $phongbans = PhongBan::all();
        return view('admin.phongban.List',[
            'title' => 'Danh sách Phòng ban',
            'phongbans' => $phongbans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.phongban.add',[
            'title' => 'Trang thêm Phòng ban'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào từ form
        // dd($request);
        $validatedData = $request->validate([
            'TenPhongBan' => 'required|string|max:255',
            'DienThoaiPhongBan' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        PhongBan::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json([
            'message' => 'Phòng ban đã được tạo thành công',
            'url' => '/admin/department/List'
        ], 
            201);
    }

    public function destroy(PhongBan $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(PhongBan $id){
        // dd($id);
        return view('admin.phongban.edit',[
            "title"=> "Sửa Phòng ban",
            "phongban" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $nhanvien = PhongBan::find($request->MaPhongBan);
    
            $nhanvien->TenPhongBan = $request->input('TenPhongBan');
            $nhanvien->DienThoaiPhongBan = $request->input('DienThoaiPhongBan');
            $nhanvien->save();
            return response()->json(['message' => 'Update oke',
                                        'url' => '/admin/department/List',
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

}
