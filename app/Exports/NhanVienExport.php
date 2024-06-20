<?php

namespace App\Exports;

use App\Models\NhanVien;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\FromCollection;

class NhanVienExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = NhanVien::all(['MaNV', 'TenNV', 'NgaySinh', 'GioiTinh', 'DiaChiNV', 'DienThoaiNV']);
        
        // Chuyển đổi collection thành mảng
        $data = $data->toArray();
        
        // Thêm tiêu đề vào đầu mảng dữ liệu
        array_unshift($data, $this->headings());
        
        // Trả về collection mới có tiêu đề
        return collect($data);
    }

    /**
     * Định nghĩa các tiêu đề cột
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Mã NV',
            'Tên NV',
            'Ngày Sinh',
            'Giới Tính',
            'Địa Chỉ',
            'Điện Thoại'
        ];
    }

    // public function exportPDF() 
    // {
    //     $nhanViens = NhanVien::all(['MaNV', 'TenNV', 'NgaySinh', 'GioiTinh', 'DiaChiNV', 'DienThoaiNV']);

    //     $pdf = Pdf::loadView('nhanvien.pdf', compact('nhanViens'));

    //     return $pdf->download('nhanvien.pdf');
    // }
}
