<?php

namespace App\Http\Controllers;

use App\Models\KhenThuong_KyLuatTapThe;
use Illuminate\Http\Request;

class KhenThuong_KyLuatTapTheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kthuong_kluats  = KhenThuong_KyLuatTapThe::all();
        // dd($kthuong_kluats); 

        if ($kthuong_kluats->isEmpty()) {
            return view('admin.khenthuong_kyluat.tapthe.List')->with('title', 'Danh sách Khen thưởng | Kỷ luật tập thể')->with('message', 'Không có dữ liệu');
        }
        // dd($kthuong_kluats);
        return view('admin.khenthuong_kyluat.tapthe.List',[
            'title' => 'Danh sách Khen thưởng | Kỷ luật Tập thể',
            'ds' => $kthuong_kluats 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.khenthuong_kyluat.tapthe.add',[
            'title' => 'Thêm Khen thưởng kỷ luật tập thể'
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
            'MaPhongBan' => 'required',
            'SoTienKhenThuong_KyLuatTapThe' => 'required',
        ]);
        // dd($validatedData);
        // Tạo nhân viên mới với dữ liệu từ form
        KhenThuong_KyLuatTapThe::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Khen thưởng | Kỷ luật tập thể đã được tạo thành công',
                                'url' => '/admin/reward-discipline/collective'
                            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhenThuong_KyLuatTapThe $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(KhenThuong_KyLuatTapThe $id){
        // dd($id);
        return view('admin.khenthuong_kyluat.tapthe.edit',[
            "title"=> "Sửa khen thưởng | kỷ luật cá nhân",
            "ktkltt" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $ktkltt = KhenThuong_KyLuatTapThe::find($request->id);
    
            $ktkltt->SoQuyetDinhKhenThuong_KyLuat = $request->input('SoQuyetDinhKhenThuong_KyLuat');
            $ktkltt->MaPhongBan = $request->input('MaPhongBan');
            $ktkltt->SoTienKhenThuong_KyLuatTapThe = $request->input('SoTienKhenThuong_KyLuatTapThe');
            $ktkltt->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/reward-discipline/collective'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
