<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoBaoHiem;
use Illuminate\Http\Request;

class SoBaoHiemCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sobaohiems = SoBaoHiem::all();
        return view('admin.sobaohiem.List',[
            'title' => 'Danh sách sổ bảo hiểm',
            'sobaohiems' => $sobaohiems
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sobaohiem.add',[
            'title' => 'Thêm sổ bảo hiểm'
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
            'NgayLapSoBaoHiem' => 'required|date',
            'ThoiHanSoBaoHiem' => 'required|string|max:255',
            'MaBaoHiem' => 'required',

        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        SoBaoHiem::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Sổ bảo hiểm đã được tạo thành công',
                                'url' => '/admin/insurance-book/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoBaoHiem $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(SoBaoHiem $id){
        // dd($id);
        return view('admin.sobaohiem.edit',[
            "title"=> "Sửa sổ bảo hiểm",
            "sobaohiem" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $sobaohiem = SoBaoHiem::find($request->id);
    
            $sobaohiem->MaNV = $request->input('MaNV');
            $sobaohiem->NgayLapSoBaoHiem = $request->input('NgayLapSoBaoHiem');
            $sobaohiem->ThoiHanSoBaoHiem = $request->input('ThoiHanSoBaoHiem');
            $sobaohiem->MaBaoHiem = $request->input('MaBaoHiem');
            $sobaohiem->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/insurance-book/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
