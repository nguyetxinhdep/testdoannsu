<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiHopDong;
use Illuminate\Http\Request;

class LoaiHopDongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hopdongs = LoaiHopDong::all();
        return view('admin.loaihopdong.List',[
            'title' => 'Danh sách Loại hợp đồng',
            'hopdongs' => $hopdongs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.loaihopdong.add',[
            'title' => 'Thêm Loại hợp đồng'
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
            'TenLoaiHopDong' => 'required|string|max:255',
            'ThoiHanHopDong' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        LoaiHopDong::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Loại Hợp đồng đã được tạo thành công',
                                'url' => '/admin/contract-type/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoaiHopDong $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(LoaiHopDong $id){
        // dd($id);
        return view('admin.loaihopdong.edit',[
            "title"=> "Sửa Loại hợp đồng",
            "hopdong" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $loaihd = LoaiHopDong::find($request->id);
    
            $loaihd->TenLoaiHopDong = $request->input('TenLoaiHopDong');
            $loaihd->ThoiHanHopDong = $request->input('ThoiHanHopDong');
            $loaihd->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/contract-type/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

    // public function export(){
    //     return Excel::download(new QuyetDinhTuyenDungExport, 'Danh_sach_Quyet_dinh_tuyen_dung.xlsx');
    // }

    // public function exportPDF() 
    // {
    //     $tuyendungs = QuyetDinhTuyenDung::all(['SoQuyetDinhTuyenDung', 'NgayQuyetDinhTuyenDung', 'ThoiGianThuViec', 
    //                 'MucLuongThuViec', 'NoiDungQuyetDInhTuyenDung', 'MaNV', 'MaPhongBan']);

    //     $pdf = Pdf::loadView('admin.loaihopdong.pdf', compact('tuyendungs'));
    //     // 
    //     // return $pdf->download('nhanvien.pdf');

    //     //xem trước file pdf
    //     return $pdf->stream('Tuyen_dung.pdf');
    // }
}
