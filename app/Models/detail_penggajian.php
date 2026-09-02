<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penggajian extends Model
{
    use HasFactory;

    protected $table = 'detail_penggajian';

    protected $fillable = [
      'penggajian_id',
      'gaji_pokok',
      'tunjangan_jabatan',
      'uang_makan',
      'lembur',
      'bonus',
      'potongan',
      'total_gaji',   
    ];

    public function penggajian()
    {
        return $this->belongsTo(Penggajian::class);
    }
}
