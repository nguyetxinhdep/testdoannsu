<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhenThuong_KyLuatTapThe extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'SoQuyetDinhKhenThuong_KyLuat',
        'MaPhongBan',
        'SoTienKhenThuong_KyLuatTapThe',
    ];

    public function quyetDinhKhenThuong_KyLuat()
    {
        return $this->belongsTo(QuyetDinhKhenThuong_KyLuat::class, 'SoQuyetDinhKhenThuong_KyLuat');
    }

    public function phongBan()
    {
        return $this->belongsTo(PhongBan::class, 'MaPhongBan');
    }
}
