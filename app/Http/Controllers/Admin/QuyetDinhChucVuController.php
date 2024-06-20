<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuyetDinhChucVu;
use Illuminate\Http\Request;

class QuyetDinhChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qdcvs = QuyetDinhChucVu::all();
        return view('admin.quyetdinhchucvu.List',[
            'title' => 'Danh sách Quyết định chức vụ',
            'qdcvs' => $qdcvs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quyetdinhchucvu.add',[
            'title' => 'Thêm Quyết định chức vụ'
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
            'NgayQuyetDinhChucVu' => 'required|date',
            'MaNV' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        QuyetDinhChucVu::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Quyết định chức vụ đã được tạo thành công',
                                'url' => '/admin/position-decision/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuyetDinhChucVu $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(QuyetDinhChucVu $id){
        // dd($id);
        return view('admin.quyetdinhchucvu.edit',[
            "title"=> "Sửa Quyết định chức vụ",
            "qdcv" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $qdcv = QuyetDinhChucVu::find($request->id);
    
            $qdcv->MaNV = $request->input('MaNV');
            $qdcv->NgayQuyetDinhChucVu = $request->input('NgayQuyetDinhChucVu');
            $qdcv->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/position-decision/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
