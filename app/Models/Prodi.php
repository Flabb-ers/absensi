<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelas()
    {

        return $this->hasMany(Kelas::class);
    }
    // Relasi one-to-one dengan model Kaprodi (Pivot)
    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'prodi_id');
    }

    // Mengambil data User melalui relasi Kaprodi
    public function userSebagaiKaprodi()
    {
        return $this->hasOneThrough(User::class, Kaprodi::class, 'prodi_id', 'id', 'id', 'user_id');
    }
}
