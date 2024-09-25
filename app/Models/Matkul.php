<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function dosen(){
        return $this->belongsTo(Dosen::class,'dosens_id');
    } 

    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangans_id');
    }
}
