<?php

use App\Http\Controllers\DosenController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SemesterController;
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
    
    // DOSEN
    Route::resource('/data-dosen',DosenController::class);
    
    //TAHUN AKADEMIK 
    Route::resource('/tahun-akademik',TahunAkademikController::class);

    // AMBIL ROLE
    Route::get('/roles',function(){
        $roles = Role::all();
        return response()->json($roles);
    });

    // //DATA USER 
    // Route::resource('/users',UserController::class);

    Route::get('/mata-kuliah', function () {
        return view('pages.data-umum.mata-kuliah');
    });


    Route::get('/wakil-direktur', function () {
        return view('pages.data-umum.wadir');
    });
});

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

