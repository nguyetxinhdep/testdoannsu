<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuyetDinhLuong;
use Illuminate\Http\Request;

class QuyetDinhLuongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qdls = QuyetDinhLuong::all();
        return view('admin.quyetdinhluong.List',[
            'title' => 'Danh sách Quyết định lương',
            'qdls' => $qdls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quyetdinhluong.add',[
            'title' => 'Thêm Quyết định lương'
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
            'MaNV' => 'required',
            'MucLuongCoBan' => 'required',
            'NgayQuyetDinhLuong' => 'required|date',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        QuyetDinhLuong::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Quyết định lương đã được tạo thành công',
                                'url' => '/admin/salary-decision/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuyetDinhLuong $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(QuyetDinhLuong $id){
        // dd($id);
        return view('admin.quyetdinhluong.edit',[
            "title"=> "Sửa Quyết định lương",
            "qdl" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $qdl = QuyetDinhLuong::find($request->id);
    
            $qdl->MaNV = $request->input('MaNV');
            $qdl->MucLuongCoBan = $request->input('MucLuongCoBan');
            $qdl->NgayQuyetDinhLuong = $request->input('NgayQuyetDinhLuong');
            $qdl->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/salary-decision/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
