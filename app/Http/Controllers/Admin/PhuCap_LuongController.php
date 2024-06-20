<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuCap_Luong;
use Illuminate\Http\Request;

class PhuCap_LuongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pcls = PhuCap_Luong::all();
        return view('admin.phucap_luong.List',[
            'title' => 'Danh sách Phụ cấp & Lương',
            'pcls' => $pcls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.phucap_luong.add',[
            'title' => 'Thêm Phụ cấp & Lương'
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
            'SoQuyetDinhLuong' => 'required',
            'MaPhuCap' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        PhuCap_Luong::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Phụ cấp & Lương đã được tạo thành công',
                                'url' => '/admin/salary_allowance/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhuCap_Luong $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(PhuCap_Luong $id){
        // dd($id);
        return view('admin.phucap_luong.edit',[
            "title"=> "Sửa Phụ cấp & Lương",
            "pcl" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $pcl = PhuCap_Luong::find($request->id);
    
            $pcl->SoQuyetDinhLuong = $request->input('SoQuyetDinhLuong');
            $pcl->MaPhuCap = $request->input('MaPhuCap');
            $pcl->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/salary_allowance/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
