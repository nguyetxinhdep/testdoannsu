<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuCap;
use Illuminate\Http\Request;

class PhuCapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phucaps = PhuCap::all();
        return view('admin.phucap.List',[
            'title' => 'Danh sách Phụ cấp',
            'phucaps' => $phucaps
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.phucap.add',[
            'title' => 'Thêm Phụ cấp'
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
            'TenPhuCap' => 'required|string|max:255',
            'SoTienPhuCap' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        PhuCap::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Phụ cấp đã được tạo thành công',
                                'url' => '/admin/allowance/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhuCap $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(PhuCap $id){
        // dd($id);
        return view('admin.phucap.edit',[
            "title"=> "Sửa Phụ cấp",
            "phucap" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $phucap = PhuCap::find($request->id);
    
            $phucap->TenPhuCap = $request->input('TenPhuCap');
            $phucap->SoTienPhuCap = $request->input('SoTienPhuCap');
            $phucap->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/allowance/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
