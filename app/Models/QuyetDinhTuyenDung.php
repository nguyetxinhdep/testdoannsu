<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinhTuyenDung extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoQuyetDinhTuyenDung';

    protected $fillable = [
        'NgayQuyetDinhTuyenDung',
        'ThoiGianThuViec',
        'MucLuongThuViec',
        'NoiDungQuyetDInhTuyenDung',
        'MaNV',
        'MaPhongBan',
    ];

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'MaPhongBan');
    }
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }
}
