<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHopDong extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaLoaiHopDong';

    protected $fillable = [
        'TenLoaiHopDong',
        'ThoiHanHopDong',
    ];

    public function hopDong()
    {
        return $this->hasMany(HopDong::class, 'MaLoaiHopDong');
    }
}
