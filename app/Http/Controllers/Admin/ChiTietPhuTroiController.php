<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChiTietPhuTroi;
use Illuminate\Http\Request;

class ChiTietPhuTroiController extends Controller
{
    public function index()
    {
        $chitiets = ChiTietPhuTroi::all();
        if ($chitiets->isEmpty()) {
            return view('admin.OT.chiTiet')->with('title', 'Danh sách chi tiết phụ trội')->with('message', 'Không có dữ liệu');
        }
    
        return view('admin.OT.chiTiet')->with('title', 'Danh sách chi tiết phụ trội')->with('chitiets', $chitiets);
    }

    public function create()
    {
        return view('admin.OT.addChiTiet',[
            'title' => 'Trang thêm Chi tiết phụ trội'
        ]);
    }

    public function store(Request $request)
    {
       // Validate dữ liệu đầu vào từ form
        // dd($request);
        try{
            $validatedData = $request->validate([
                'MaNV' => 'required|integer',
                'SoPhieu' => 'required|integer',
                'SoGio' => 'required|integer',
            ]);
    
            // Tạo nhân viên mới với dữ liệu từ form
            ChiTietPhuTroi::create($validatedData);
    
            // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
            return response()->json(['message' => 'Phiếu ghi phụ trội đã được tạo thành công'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Tìm bản ghi với MaChiTiet tương ứng
            $chiTietPhuTroi = ChiTietPhuTroi::where('MaChiTiet', $id)->firstOrFail();

            // Xóa bản ghi
            $chiTietPhuTroi->delete();
    
            // Trả về phản hồi JSON thành công
            return response()->json(['message' => 'Xóa thành công!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function edit(ChiTietPhuTroi $id){
        // dd($id);
        return view('admin.OT.editChiTiet',[
            "title"=> "Sửa Chi tiết phụ trội",
            "chitiet" => $id
        ]);
    }

    public function update(Request $request)
    {
        try{
            $chitiet = ChiTietPhuTroi::find($request->MaChiTiet);
            // dd($chitiet);
            $chitiet->MaNV = $request->input('MaNV');
            $chitiet->SoPhieu = $request->input('SoPhieu');
            $chitiet->SoGio = $request->input('SoGio');
            $chitiet->save();
            return response()->json(['message' => 'Update oke'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

}
