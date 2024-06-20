<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietQuyetDinhChucVu;
use Illuminate\Http\Request;

class ChiTietQuyetDinhChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctcvs = ChiTietQuyetDinhChucVu::all();
        return view('admin.quyetdinhchucvu.chitiet.List',[
            'title' => 'Danh sách Chi tiêt Quyết định chức vụ',
            'ctcvs' => $ctcvs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quyetdinhchucvu.chitiet.add',[
            'title' => 'Thêm Chi tiêt Quyết định chức vụ'
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
            'SoQuyetDinhChucVu' => 'required',
            'MaChucVu' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        ChiTietQuyetDinhChucVu::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Chi tiêt Quyết định chức vụ đã được tạo thành công',
                                'url' => '/admin/position-detail/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChiTietQuyetDinhChucVu $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(ChiTietQuyetDinhChucVu $id){
        // dd($id);
        return view('admin.quyetdinhchucvu.chitiet.edit',[
            "title"=> "Sửa Chi tiêt Quyết định chức vụ",
            "ctcv" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $qdcv = ChiTietQuyetDinhChucVu::find($request->id);
    
            $qdcv->SoQuyetDinhChucVu = $request->input('SoQuyetDinhChucVu');
            $qdcv->MaChucVu = $request->input('MaChucVu');
            $qdcv->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/position-detail/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
