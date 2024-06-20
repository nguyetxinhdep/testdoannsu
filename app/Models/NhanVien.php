<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaNV';
    protected $fillable = [
        'TenNV',
        'GioiTinh',
        'NgaySinh',
        'DiaChiNV',
        'DienThoaiNV',
    ];

    public function chiTietPhuTroi()
    {
        return $this->hasMany(ChiTietPhuTroi::class, 'MaNV');
    }

    public function khenThuong_KyLuatCaNhan()
    {
        return $this->hasMany(KhenThuong_KyLuatCaNhan::class, 'MaNV');
    }

    public function quyetDinhTuyenDung()
    {
        return $this->hasMany(QuyetDinhTuyenDung::class, 'MaNV');
    }

    public function hopDong()
    {
        return $this->hasMany(HopDong::class, 'MaNV');
    }
    public function soBaoHiem()
    {
        return $this->hasMany(SoBaoHiem::class, 'MaNV');
    }
    public function quyetDinhLuong()
    {
        return $this->hasMany(QuyetDinhLuong::class, 'MaNV');
    }
    public function quyetDinhChucVu()
    {
        return $this->hasMany(QuyetDinhChucVu::class, 'MaNV');
    }
    public function thongTinChamCong()
    {
        return $this->hasMany(ThongTinChamCong::class, 'MaNV');
    }
}
