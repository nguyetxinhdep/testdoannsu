<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaoHiem;
use Illuminate\Http\Request;

class BaoHiemCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baohiems = BaoHiem::all();
        return view('admin.baohiem.List',[
            'title' => 'Danh sách bảo hiểm',
            'baohiems' => $baohiems
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.baohiem.add',[
            'title' => 'Thêm bảo hiểm'
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
            'TenBaoHiem' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        BaoHiem::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Bảo hiểm đã được tạo thành công',
                                'url' => '/admin/insurance/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaoHiem $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(BaoHiem $id){
        // dd($id);
        return view('admin.baohiem.edit',[
            "title"=> "Sửa bảo hiểm",
            "baohiem" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $baohiem = BaoHiem::find($request->id);
    
            $baohiem->TenBaoHiem = $request->input('TenBaoHiem');
            $baohiem->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/insurance/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
