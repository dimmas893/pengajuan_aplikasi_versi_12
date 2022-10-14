<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $fillable = [
        'tanggal',
        'user_id_pengajuan',
        'user_id_approval',
        'suer_id_approval_superadmin',
        'total_biaya',
    ];

    public function level_1()
    {
        return $this->belongsTo(User::class, 'level_1', 'id');
    }

    public function level_2()
    {
        return $this->belongsTo(User::class, 'level_2', 'id');
    }

    public function level_3()
    {
        return $this->belongsTo(User::class, 'level_3', 'id');
    }
    public function user_pengajuan()
    {
        return $this->belongsTo(User::class, 'user_id_pengajuan', 'id');
    }
}
