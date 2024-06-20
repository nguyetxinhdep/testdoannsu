<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhenThuong_KyLuatCaNhan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'SoQuyetDinhKhenThuong_KyLuat',
        'MaNV',
        'SoTienKhenThuong_KyLuatCaNhan',
    ];

    public function quyetDinhKhenThuong_KyLuat()
    {
        return $this->belongsTo(QuyetDinhKhenThuong_KyLuat::class, 'SoQuyetDinhKhenThuong_KyLuat');
    }

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }

}
