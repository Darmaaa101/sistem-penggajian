<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pegawai;

class jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
        'tunjangan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
