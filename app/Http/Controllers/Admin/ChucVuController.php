<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chucvus = ChucVu::all();
        return view('admin.chucvu.List',[
            'title' => 'Danh sách Chức vụ',
            'chucvus' => $chucvus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chucvu.add',[
            'title' => 'Thêm Chức vụ'
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
            'TenChucVu' => 'required|string|max:255',
            'HeSoLuong' => 'required',
            'PhuCapChucVu' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        ChucVu::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Chức vụ đã được tạo thành công',
                                'url' => '/admin/position/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChucVu $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(ChucVu $id){
        // dd($id);
        return view('admin.chucvu.edit',[
            "title"=> "Sửa Chức vụ",
            "chucvu" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $chucvu = ChucVu::find($request->id);
    
            $chucvu->TenChucVu = $request->input('TenChucVu');
            $chucvu->HeSoLuong = $request->input('HeSoLuong');
            $chucvu->PhuCapChucVu = $request->input('PhuCapChucVu');
            $chucvu->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/position/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
