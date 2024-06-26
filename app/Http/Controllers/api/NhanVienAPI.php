<?php

namespace App\Http\Controllers\api;

use App\Exports\NhanVienExport;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class NhanVienAPI extends Controller
{
    public function indexapi()
    {
        $nhanviens = NhanVien::all();
        // Lấy tất cả nhân viên

        // Trả về danh sách nhân viên
        return response()->json($nhanviens);
    }

    public function addapi(Request $request)
    {
        // Validate dữ liệu đầu vào từ form
        // dd($request);
        $validatedData = Validator::make($request->all(),[
            'TenNV' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'GioiTinh' => 'required|string|max:255',
            'DiaChiNV' => 'required|string|max:255',
            'DienThoaiNV' => 'required|string|max:255',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->toJson(),400);
        }
        // Tạo nhân viên mới với dữ liệu từ form
        $user = NhanVien::create(array_merge(
            $validatedData->validate(),
        ));

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json([
            'message'=>'User successsully register',
            'user'=>$user,
        ],201);
    }

    public function updateapi(Request $request)
    {
        // Validate dữ liệu đầu vào từ form
        // dd($request);

        $validatedData = Validator::make($request->all(),[
            'TenNV' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'GioiTinh' => 'required|string|max:255',
            'DiaChiNV' => 'required|string|max:255',
            'DienThoaiNV' => 'required|string|max:255',
        ]);

        // dd($request->MaNV);

        if($validatedData->fails()){
            return response()->json($validatedData->errors()->toJson(),400);
        }
        $nhanvien = NhanVien::find($request->MaNV);
        // Tạo nhân viên mới với dữ liệu từ form
        $nhanvien->TenNV = $request->input('TenNV');
        $nhanvien->NgaySinh = $request->input('NgaySinh');
        $nhanvien->GioiTinh = $request->input('GioiTinh');
        $nhanvien->DiaChiNV = $request->input('DiaChiNV');
        $nhanvien->DienThoaiNV = $request->input('DienThoaiNV');
        $nhanvien->save();

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json([
            'message'=>'Nhan vien successsully update',
            'nhanvien'=>$nhanvien,
        ],201);
    }

    public function deleteapi(NhanVien $id){
        $id->delete();
        return response()->json([
            'message'=>'Nhan vien successsully delete',
            'nhanviendelete'=>$id,
        ],201);
    }

    public function exportexcelapi(){
        return Excel::download(new NhanVienExport, 'danh_sach_nhan_vien.xlsx');
    }

    public function exportpdfapi() 
    {
        $nhanViens = NhanVien::all(['MaNV', 'TenNV', 'NgaySinh', 'GioiTinh', 'DiaChiNV', 'DienThoaiNV']);

        $pdf = Pdf::loadView('admin.nhanvien.pdf', compact('nhanViens'));
        // 
        // return $pdf->download('nhanvien.pdf');

        //xem trước file pdf
        return $pdf->stream('myPDF.pdf');
    }

    public function searchByName(Request $request){
        // Nhận giá trị của tham số query 'employeeName'
        // $employeeName = $request->input('employeeName');
        $employeeName = $request->employeeName;
        $employees = NhanVien::where('TenNV', 'like', '%' . $employeeName . '%')->get();
        return response()->json([
            'message' => 'tìm kiếm nhân viên',
            "nhanvientim" => $employees,
        ], 201);
    }
}
