<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuGhiNhanPhuTroi extends Model
{
    use HasFactory;
    protected $primaryKey = 'SoPhieu';
    protected $fillable = [
        'NgayPhuTroi',
        'HinhThucPhuTroi',
        'HeSoPhuTroi',
    ];

    public function chiTietPhuTroi()
    {
        return $this->hasMany(ChiTietPhuTroi::class, 'SoPhieu');
    }
}
