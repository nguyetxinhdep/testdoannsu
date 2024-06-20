<?php

namespace App\Http\Controllers;

use App\Models\KhenThuong_KyLuatCaNhan;
use Illuminate\Http\Request;

class KhenThuong_KyLuatCaNhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kthuong_kluats  = KhenThuong_KyLuatCaNhan::all();
        // dd($kthuong_kluats); 

        if ($kthuong_kluats->isEmpty()) {
            return view('admin.khenthuong_kyluat.canhan.List')->with('title', 'Danh sách Khen thưởng | Kỷ luật cá nhân')->with('message', 'Không có dữ liệu');
        }
        // dd($kthuong_kluats);
        return view('admin.khenthuong_kyluat.canhan.List',[
            'title' => 'Danh sách Khen thưởng | Kỷ luật cấ nhân',
            'ds' => $kthuong_kluats 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.khenthuong_kyluat.canhan.add',[
            'title' => 'Thêm Khen thưởng kỷ luật cá nhân'
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
            'SoQuyetDinhKhenThuong_KyLuat' => 'required',
            'MaNV' => 'required',
            'SoTienKhenThuong_KyLuatCaNhan' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        KhenThuong_KyLuatCaNhan::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Khen thưởng | Kỷ luật cá nhân đã được tạo thành công',
                                'url' => '/admin/reward-discipline/individual'
                            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhenThuong_KyLuatCaNhan $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(KhenThuong_KyLuatCaNhan $id){
        // dd($id);
        return view('admin.khenthuong_kyluat.canhan.edit',[
            "title"=> "Sửa khen thưởng | kỷ luật cá nhân",
            "ktklcn" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $ktklcn = KhenThuong_KyLuatCaNhan::find($request->id);
    
            $ktklcn->SoQuyetDinhKhenThuong_KyLuat = $request->input('SoQuyetDinhKhenThuong_KyLuat');
            $ktklcn->MaNV = $request->input('MaNV');
            $ktklcn->SoTienKhenThuong_KyLuatCaNhan = $request->input('SoTienKhenThuong_KyLuatCaNhan');
            $ktklcn->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/reward-discipline/individual'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
