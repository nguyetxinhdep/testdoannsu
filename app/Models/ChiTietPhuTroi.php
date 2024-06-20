<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhuTroi extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaChiTiet';
    public $incrementing = false; // If composite primary keys are used, set incrementing to false.

    protected $fillable = [
        'MaNV',
        'MaChiTiet',
        'SoPhieu',
        'SoGio',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }

    public function phieuGhiNhanPhuTroi()
    {
        return $this->belongsTo(PhieuGhiNhanPhuTroi::class, 'SoPhieu');
    }
}
