<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoHiem extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaBaoHiem';

    protected $fillable = [
        'TenBaoHiem',
    ];

    public function soBaoHiem()
    {
        return $this->hasMany(SoBaoHiem::class, 'MaBaoHiem');
    }
}
