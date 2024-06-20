<?php

namespace App\Exports;

use App\Models\QuyetDinhKhenThuong_KyLuat;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuyetDinhKhenThuong_KyLuatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = QuyetDinhKhenThuong_KyLuat::all(['SoQuyetDinhKhenThuong_KyLuat', 'NgayQuyetDinhKhenThuong_KyLuat', 
                            'NoiDungQuyetDinhKhenThuong_KyLuat']);
        
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
            'Số quyết định khen thưởng kỷ luật',
            'Ngày quyết định',
            'Nội dung',
        ];
    }
}
