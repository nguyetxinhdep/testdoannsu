<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuCap extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaPhuCap';
    public $incrementing = false; // If composite primary keys are used, set incrementing to false.

    protected $fillable = [
        'TenPhuCap',
        'SoTienPhuCap',
    ];


    public function phuCap_Luong()
    {
        return $this->hasMany(PhuCap_Luong::class, 'MaPhuCap');
    }
}
