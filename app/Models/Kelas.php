<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function prodi()
    {
        return  $this->belongsTo(Prodi::class);
    }
    public function semester()
    {
        return  $this->belongsTo(Semester::class);
    }
}
