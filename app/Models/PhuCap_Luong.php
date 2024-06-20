<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuCap_Luong extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'SoQuyetDinhLuong',
        'MaPhuCap',
    ];

    public function quyetDinhLuong()
    {
        return $this->belongsTo(QuyetDinhLuong::class, 'SoQuyetDinhLuong');
    }

    public function phuCap()
    {
        return $this->belongsTo(PhuCap::class, 'MaPhuCap');
    }
}
