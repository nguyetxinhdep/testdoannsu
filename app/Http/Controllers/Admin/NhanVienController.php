<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NhanVienExport;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Readline\Hoa\Console;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhanviens = NhanVien::all();
        return view('admin.nhanvien.List',[
            'title' => 'Danh sách nhân viên',
            'nhanviens' => $nhanviens
        ]);
    }

    public function searchByName(Request $request){
        // Nhận giá trị của tham số query 'employeeName'
        // $employeeName = $request->input('employeeName');
        $employeeName = $request->query('employeeName');
        $employees = NhanVien::where('TenNV', 'like', '%' . $employeeName . '%')->get();
        return response()->json([
            'message' => 'tìm kiếm nhân viên',
            "nhanvientim" => $employees,
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.nhanvien.create',[
            'title' => 'Trang thêm nhân viên'
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
            'TenNV' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'GioiTinh' => 'required|string|max:255',
            'DiaChiNV' => 'required|string|max:255',
            'DienThoaiNV' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        NhanVien::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Nhân viên đã được tạo thành công'], 201);
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
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(NhanVien $id){
        // dd($id);
        return view('admin.nhanvien.edit',[
            "title"=> "Sửa Nhân viên",
            "nhanvien" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $nhanvien = NhanVien::find($request->input('MaNV'));
    
            $nhanvien->TenNV = $request->input('TenNV');
            $nhanvien->NgaySinh = $request->input('NgaySinh');
            $nhanvien->GioiTinh = $request->input('GioiTinh');
            $nhanvien->DiaChiNV = $request->input('DiaChiNV');
            $nhanvien->DienThoaiNV = $request->input('DienThoaiNV');
            $nhanvien->save();
            return response()->json(['message' => 'Update oke'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NhanVien $id)
    {
        $id->delete();
    }

    public function deleteapi(NhanVien $id){
        $id->delete();
        return response()->json([
            'message'=>'Nhan vien successsully delete',
            'nhanviendelete'=>$id,
        ],201);
    }

    public function export(){
        return Excel::download(new NhanVienExport, 'danh_sach_nhan_vien.xlsx');
    }
    

    public function exportPDF() 
    {
        $nhanViens = NhanVien::all(['MaNV', 'TenNV', 'NgaySinh', 'GioiTinh', 'DiaChiNV', 'DienThoaiNV']);

        $pdf = Pdf::loadView('admin.nhanvien.pdf', compact('nhanViens'));
        // 
        // return $pdf->download('nhanvien.pdf');

        //xem trước file pdf
        return $pdf->stream('myPDF.pdf');
    }

    
}
