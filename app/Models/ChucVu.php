<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaChucVu';
    protected $fillable = [
        'TenChucVu',
        'HeSoLuong',
        'PhuCapChucVu',
    ];

    public function chiTietQuyetDinhChucVu()
    {
        return $this->hasMany(ChiTietQuyetDinhChucVu::class, 'MaChucVu');
    }
}
