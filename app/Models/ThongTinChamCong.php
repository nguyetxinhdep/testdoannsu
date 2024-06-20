<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinChamCong extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'MaNV',
        'Checkin',
        'Checkout',
        'NgayChamCong',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV');
    }
}
