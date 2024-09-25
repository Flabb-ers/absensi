<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\WadirController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TahunAkademikController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/auth/login", function () {
    return view("pages.auth.login");
});
Route::get('/', function () {
    return redirect("/dashboard");
});
Route::get("/dashboard", function () {
    return view("pages.index");
});




// Data Master
Route::prefix('presensi/data-master')->group(function () {
    // DATA KELAS
    Route::resource('/daftar-kelas', KelasController::class);

    // SEMESTER
    Route::resource('/semester', SemesterController::class);
    
    // PRODI
    Route::resource('/program-studi', ProdiController::class);
    
    // RUANGAN
    Route::resource('/ruangan', RuanganController::class);
    
    //TAHUN AKADEMIK 
    Route::resource('/tahun-akademik',TahunAkademikController::class);
    
    // DOSEN
    Route::resource('/data-dosen',DosenController::class);
    
    // KAPRODI
    Route::resource('/data-kaprodi',KaprodiController::class);

    // WADIR
    Route::resource('/data-wadir',WadirController::class);

    // Direktur
    Route::resource('/data-direktur',DirekturController::class);
    
    // MATKUK
    Route::resource('/mata-kuliah',MatkulController::class);
});

    // MAHASISWA
    Route::resource('/data-mahasiswa',MahasiswaController::class);




Route::get("/jadwal-mengajar", function () {
    return view("pages.jadwal-mengajar.index");
});
Route::get("/daftar-jadwal-mengajar", function () {
    return view("pages.jadwal-mengajar.dosen");
});


Route::get("/data-direktur", function () {
    return view("pages.data-direktur.index");
});
Route::get("/data-dosen", function () {
    return view("pages.data-dosen.index");
});


Route::get("/presensi", function () {
    return view('pages.presensi.index');
});


//EDIT STATUS SEMESTER
Route::put('/semester/status', [SemesterController::class, 'gantiStatus'])->name('status.update');

//test
// route::get('/test',function(){
//     return view('test');
// });

