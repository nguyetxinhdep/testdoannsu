<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinhChucVu extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoQuyetDinhChucVu';
    protected $fillable = [
        'MaNV',
        'NgayQuyetDinhChucVu',
    ];

    public function chiTietQuyetDinhChucVu()
    {
        return $this->hasMany(ChiTietQuyetDinhChucVu::class, 'SoQuyetDinhChucVu');
    }
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }
}
