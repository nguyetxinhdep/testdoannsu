<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinhKhenThuong_KyLuat extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoQuyetDinhKhenThuong_KyLuat';
    protected $fillable = [
        'NgayQuyetDinhKhenThuong_KyLuat',
        'NoiDungQuyetDinhKhenThuong_KyLuat',
    ];

    public function khenThuong_KyLuatCaNhan()
    {
        return $this->hasMany(KhenThuong_KyLuatCaNhan::class, 'SoQuyetDinhKhenThuong_KyLuat');
    }

    public function khenThuong_KyLuatTapThe()
    {
        return $this->hasMany(KhenThuong_KyLuatTapThe::class, 'SoQuyetDinhKhenThuong_KyLuat');
    }
}
