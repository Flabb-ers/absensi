<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAkademik;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Prodi::create([
            'nama_prodi'=>'Teknik Informatika',
            'singkatan'=>'TI',
            'kode_prodi'=>'WKWKWKW',
            'Jenjang'=>'D3',
        ]);
        Prodi::create([
            'nama_prodi'=>'Akuntansi',
            'singkatan'=>'AK',
            'kode_prodi'=>'WKWKWKW',
            'Jenjang'=>'D3',
        ]);
        Prodi::create([
            'nama_prodi'=>'Administrasi Bisnis',
            'singkatan'=>'AB',
            'kode_prodi'=>'WKWKWKW',
            'Jenjang'=>'D3',
        ]);

        Semester::create([
            'semester'=>1
        ]);
        Semester::create([
            'semester'=>12
        ]);
        Semester::create([
            'semester'=>3
        ]);
        Semester::create([
            'semester'=>4
        ]);
        Semester::create([
            'semester'=>5
        ]);
        Semester::create([
            'semester'=>6
        ]);
        Semester::create([
            'semester'=>7
        ]);
        Semester::create([
            'semester'=>8
        ]);

        TahunAkademik::create([
            'tahun_akademik'=>'2024/2025'
        ]);
        TahunAkademik::create([
            'tahun_akademik'=>'2024/2026'
        ]);
        TahunAkademik::create([
            'tahun_akademik'=>'2024/2027'
        ]);
        TahunAkademik::create([
            'tahun_akademik'=>'2024/2028'
        ]);
    }
}
