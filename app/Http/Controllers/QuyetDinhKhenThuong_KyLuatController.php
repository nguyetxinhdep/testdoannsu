<?php

namespace App\Http\Controllers;

use App\Exports\QuyetDinhKhenThuong_KyLuatExport;
use App\Models\QuyetDinhKhenThuong_KyLuat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuyetDinhKhenThuong_KyLuatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kthuong_kluats  = QuyetDinhKhenThuong_KyLuat::all();
        // dd($kthuong_kluats); 

        if ($kthuong_kluats->isEmpty()) {
            return view('admin.khenthuong_kyluat.quyetdinh.List')->with('title', 'Danh sách Quyết định Khen thưởng | Kỷ luật')->with('message', 'Không có dữ liệu');
        }
        // dd($kthuong_kluats);
        return view('admin.khenthuong_kyluat.quyetdinh.List',[
            'title' => 'Danh sách Quyết định Khen thưởng | Kỷ luật',
            'ds' => $kthuong_kluats 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.khenthuong_kyluat.quyetdinh.add',[
            'title' => 'Thêm quyết định Khen thưởng kỷ luật'
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
            'NgayQuyetDinhKhenThuong_KyLuat' => 'required|date',
            'NoiDungQuyetDinhKhenThuong_KyLuat' => 'required|string|max:255',
        ]);

        // Tạo nhân viên mới với dữ liệu từ form
        QuyetDinhKhenThuong_KyLuat::create($validatedData);

        // Chuyển hướng đến route hoặc view mong muốn sau khi tạo nhân viên thành công
        return response()->json(['message' => 'Quyết định khen thưởng | kỷ luật đã được tạo thành công',
                                'url' => '/admin/reward-discipline/decide'
                            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuyetDinhKhenThuong_KyLuat $id)
    {
        $id->delete();
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(QuyetDinhKhenThuong_KyLuat $id){
        // dd($id);
        return view('admin.khenthuong_kyluat.quyetdinh.edit',[
            "title"=> "Sửa quyết định khen thưởng | kỷ luật",
            "ktkl" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $ktkl = QuyetDinhKhenThuong_KyLuat::find($request->SoQuyetDinh);
    
            $ktkl->NgayQuyetDinhKhenThuong_KyLuat = $request->input('NgayQuyetDinhKhenThuong_KyLuat');
            $ktkl->NoiDungQuyetDinhKhenThuong_KyLuat = $request->input('NoiDungQuyetDinhKhenThuong_KyLuat');
            $ktkl->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/admin/reward-discipline/decide'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

    public function export(){
        return Excel::download(new QuyetDinhKhenThuong_KyLuatExport, 'DS_QD_KhenThuong_KyLuat.xlsx');
    }

    public function exportPDF() 
    {
        $ktkls = QuyetDinhKhenThuong_KyLuat::all(['SoQuyetDinhKhenThuong_KyLuat', 'NgayQuyetDinhKhenThuong_KyLuat', 
                                        'NoiDungQuyetDinhKhenThuong_KyLuat']);

        $pdf = Pdf::loadView('admin.khenthuong_kyluat.quyetdinh.pdf', compact('ktkls'));
        // 
        // return $pdf->download('nhanvien.pdf');

        //xem trước file pdf
        return $pdf->stream('DS_QD_KhenThuong_KyLuat.pdf');
    }
}
