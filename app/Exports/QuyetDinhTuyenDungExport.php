<?php

namespace App\Exports;

use App\Models\QuyetDinhTuyenDung;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuyetDinhTuyenDungExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = QuyetDinhTuyenDung::all(['SoQuyetDinhTuyenDung', 'NgayQuyetDinhTuyenDung', 'ThoiGianThuViec', 
                                        'MucLuongThuViec', 'NoiDungQuyetDInhTuyenDung', 'MaNV', 'MaPhongBan']);
        
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
            'Số quyết định tuyển dụng',
            'Ngày quyết định tuyển dụng',
            'Thời gian thử việc',
            'Mức lương thử việc',
            'Nơi dùng quyết định tuyển dụng',
            'Mã nhân viên',
            'Mã phòng ban'
        ];
    }
}



