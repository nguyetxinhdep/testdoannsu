<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    protected $primaryKey = 'MaPhongBan';
    protected $fillable = [
        'TenPhongBan',
        'DienThoaiPhongBan',
    ];

    public function quyetDinhTuyenDung()
    {
        return $this->hasMany(QuyetDinhTuyenDung::class, 'MaPhongBan');
    }

    public function khenThuong_KyLuatTapThe()
    {
        return $this->hasMany(KhenThuong_KyLuatTapThe::class, 'SoQuyetDinhKhenThuong_KyLuat');
    }
}
