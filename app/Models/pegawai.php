<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jabatan;

class pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'nip',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'tanggal_masuk',
        'status',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function penggajian()
    {
        return $this->hasMany(Penggajian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
