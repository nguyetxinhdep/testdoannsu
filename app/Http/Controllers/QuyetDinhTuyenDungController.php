<?php

namespace App\Http\Controllers;

use App\Exports\QuyetDinhTuyenDungExport;
use App\Models\QuyetDinhTuyenDung;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuyetDinhTuyenDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hirings = QuyetDinhTuyenDung::all();
        return view('admin.tuyendung.List',[
            'title' => 'Danh sách Quyết định tuyển dụng',
            'hirings' => $hirings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tuyendung.add',[
            'title' => 'Thêm quyết định tuyển dụng'
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
            'NgayQuyetDinhTuyenDung' => 'required|date',
            'ThoiGianThuViec' => 'required|string|max:255',
            'MucLuongThuViec' => 'required',
            'NoiDungQuyetDInhTuyenDung' => 'required|string|max:255',
            'MaNV' => 'required',
            'MaPhongBan' => 'required',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        QuyetDinhTuyenDung::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Quyết định tuyển dụng đã được tạo thành công',
                                'url' => '/admin/hiring/List'
                            ], 201);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuyetDinhTuyenDung $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(QuyetDinhTuyenDung $id){
        // dd($id);
        return view('admin.tuyendung.edit',[
            "title"=> "Sửa quyết định tuyển dụng",
            "tuyendung" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $tuyendung = QuyetDinhTuyenDung::find($request->SoQuyetDinh);
    
            $tuyendung->NgayQuyetDinhTuyenDung = $request->input('NgayQuyetDinhTuyenDung');
            $tuyendung->ThoiGianThuViec = $request->input('ThoiGianThuViec');
            $tuyendung->MucLuongThuViec = $request->input('MucLuongThuViec');
            $tuyendung->NoiDungQuyetDInhTuyenDung = $request->input('NoiDungQuyetDInhTuyenDung');
            $tuyendung->MaNV = $request->input('MaNV');
            $tuyendung->MaPhongBan = $request->input('MaPhongBan');
            $tuyendung->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/hiring/List'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

    public function export(){
        return Excel::download(new QuyetDinhTuyenDungExport, 'Danh_sach_Quyet_dinh_tuyen_dung.xlsx');
    }

    public function exportPDF() 
    {
        $tuyendungs = QuyetDinhTuyenDung::all(['SoQuyetDinhTuyenDung', 'NgayQuyetDinhTuyenDung', 'ThoiGianThuViec', 
                    'MucLuongThuViec', 'NoiDungQuyetDInhTuyenDung', 'MaNV', 'MaPhongBan']);

        $pdf = Pdf::loadView('admin.tuyendung.pdf', compact('tuyendungs'));
        // 
        // return $pdf->download('nhanvien.pdf');

        //xem trước file pdf
        return $pdf->stream('Tuyen_dung.pdf');
    }
}
