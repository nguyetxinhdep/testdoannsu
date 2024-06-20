<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhieuGhiNhanPhuTroi;
use Illuminate\Http\Request;

class PhieuGhiPhuTroiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phieughi = PhieuGhiNhanPhuTroi::all();
        if ($phieughi->isEmpty()) {
            return view('admin.OT.phieughi')->with('title', 'Danh sách Phiếu ghi phụ trội')->with('message', 'Không có dữ liệu');
        }
    
        return view('admin.OT.phieughi')->with('title', 'Danh sách Phiếu ghi phụ trội')->with('phieughi', $phieughi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.OT.addPhieuGhi',[
            'title' => 'Trang thêm Phiếu ghi phụ trội'
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
            'NgayPhuTroi' => 'required|date',
            'HinhThucPhuTroi' => 'required|string|max:255',
            'HeSoPhuTroi' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        PhieuGhiNhanPhuTroi::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Phiếu ghi phụ trội đã được tạo thành công'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhieuGhiNhanPhuTroi $id)
    {
        return view('admin.OT.editPhieuGhi',[
            "title" => 'Sửa phiếu ghi',
            "phieu" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'NgayPhuTroi' => 'required|date',
            'HinhThucPhuTroi' => 'required|string|max:255',
            'HeSoPhuTroi' => 'required',
        ]);
        try {
            // Find the record by SoPhieu
            $phieu = PhieuGhiNhanPhuTroi::find($request->SoPhieu);

            if (!$phieu) {
                return response()->json(['message' => 'Không tìm thấy phiếu ghi với số phiếu được cung cấp.'], 404);
            }
    
            // Update the record with new data
            $phieu->NgayPhuTroi = $validatedData['NgayPhuTroi'];
            $phieu->HinhThucPhuTroi = $validatedData['HinhThucPhuTroi'];
            $phieu->HeSoPhuTroi = $validatedData['HeSoPhuTroi'];
            $phieu->save();

            // Return success response
            return response()->json(['message' => 'Phiếu ghi đã được sửa!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra khi sửa phiếu ghi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhieuGhiNhanPhuTroi $id)
    {
        try{
            $id->delete();
            return response()->json(['message' => 'Xóa Thành công!'], 200);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
