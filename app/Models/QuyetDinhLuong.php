<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinhLuong extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoQuyetDinhLuong';

    protected $fillable = [
        'MaNV',
        'MucLuongCoBan',
        'NgayQuyetDinhLuong',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }

    public function phuCap_Luong()
    {
        return $this->hasMany(PhuCap_Luong::class, 'SoQuyetDinhLuong');
    }
}
