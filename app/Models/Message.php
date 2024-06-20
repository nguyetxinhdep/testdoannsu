<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'adminid',
        'name',
        'message',
    ];

    public function nhanVien()
    {
        return $this->belongsTo(User::class, 'adminid');
    }
}
