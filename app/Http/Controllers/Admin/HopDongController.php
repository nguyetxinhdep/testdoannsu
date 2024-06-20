<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HopDong;
use Illuminate\Http\Request;

class HopDongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hopdongs = HopDong::all();
        return view('admin.hopdong.List',[
            'title' => 'Danh sách hợp đồng',
            'hopdongs' => $hopdongs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hopdong.add',[
            'title' => 'Thêm hợp đồng'
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
            'MaLoaiHopDong' => 'required',
            'MaNV' => 'required',
            'NgayLapHopDong' => 'required|date',
            'NoiDungHopDong' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        hopdong::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Hợp đồng đã được tạo thành công',
                                'url' => '/admin/contract/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HopDong $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(HopDong $id){
        // dd($id);
        return view('admin.hopdong.edit',[
            "title"=> "Sửa hợp đồng",
            "hopdong" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $hd = HopDong::find($request->id);
    
            $hd->MaLoaiHopDong = $request->input('MaLoaiHopDong');
            $hd->MaNV = $request->input('MaNV');
            $hd->NgayLapHopDong = $request->input('NgayLapHopDong');
            $hd->NoiDungHopDong = $request->input('NoiDungHopDong');
            $hd->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/contract/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
