<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoHopDong';

    protected $fillable = [
        'MaLoaiHopDong',
        'MaNV',
        'NgayLapHopDong',
        'NoiDungHopDong',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }

    public function loaiHopDong()
    {
        return $this->belongsTo(LoaiHopDong::class, 'MaLoaiHopDong');
    }
}
