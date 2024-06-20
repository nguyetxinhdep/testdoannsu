<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietQuyetDinhChucVu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'SoQuyetDinhChucVu',
        'MaChucVu',
    ];

    public function quyetDinhChucVu()
    {
        return $this->belongsTo(QuyetDinhChucVu::class, 'SoQuyetDinhChucVu');
    }
    public function chucVu()
    {
        return $this->belongsTo(ChucVu::class, 'MaChucVu');
    }
}
