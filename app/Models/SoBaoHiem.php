<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoBaoHiem extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaSoBaoHiem';

    protected $fillable = [
        'MaNV',
        'NgayLapSoBaoHiem',
        'ThoiHanSoBaoHiem',
        'MaBaoHiem',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }

    public function baoHiem()
    {
        return $this->belongsTo(BaoHiem::class, 'MaBaoHiem');
    }
}
