@extends('layouts.main')

@section('container')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card text-bg-light mb-3">
                    <div class="card-header">Matkul 1</div>
                    <div class="card-body">
                        <ul class="info-list">
                            <li><strong>Hari:</strong> Senin</li>
                            <li><strong>SKS:</strong> 2</li>
                            <li><strong>Waktu:</strong> 08.00-09.20</li>
                            <li><strong>Kelas:</strong> TI 2A</li>
                            <li><strong>Semester:</strong> Semester 2</li>
                            <li><strong>Ruangan:</strong> LS .1.1</li>
                        </ul>
                        <a href="/presensi" class="btn btn-dark btn-sm me-2">
                            <span class="mdi mdi-clipboard-edit-outline"></span> Isi Absensi
                        </a>
                        <a href="#" class="btn btn-success btn-sm">
                            <span class="mdi mdi-file-document-outline"></span> Rekap Absen
                        </a>
                    </div>
                </div>
            </div>
            <!-- Salin div di atas untuk card kedua dan ketiga -->
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card text-bg-light mb-3">
                    <div class="card-header">Matkul 2</div>
                    <div class="card-body">
                        <ul class="info-list">
                            <li><strong>Hari:</strong> Selasa</li>
                            <li><strong>SKS:</strong> 3</li>
                            <li><strong>Waktu:</strong> 10.00-11.20</li>
                            <li><strong>Kelas:</strong> TI 3B</li>
                            <li><strong>Semester:</strong> Semester 3</li>
                            <li><strong>Ruangan:</strong> LS .2.2</li>
                        </ul>
                        <a href="/presensi" class="btn btn-dark btn-sm me-2">
                            <span class="mdi mdi-clipboard-edit-outline"></span> Isi Absensi
                        </a>
                        <a href="#" class="btn btn-success btn-sm">
                            <span class="mdi mdi-file-document-outline"></span> Rekap Absen
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card text-bg-light mb-3">
                    <div class="card-header">Matkul 3</div>
                    <div class="card-body">
                        <ul class="info-list">
                            <li><strong>Hari:</strong> Rabu</li>
                            <li><strong>SKS:</strong> 4</li>
                            <li><strong>Waktu:</strong> 13.00-14.20</li>
                            <li><strong>Kelas:</strong> TI 4C</li>
                            <li><strong>Semester:</strong> Semester 4</li>
                            <li><strong>Ruangan:</strong> LS .3.3</li>
                        </ul>
                        <a href="/presensi" class="btn btn-dark btn-sm me-2">
                            <span class="mdi mdi-clipboard-edit-outline"></span> Isi Absensi
                        </a>
                        <a href="#" class="btn btn-success btn-sm">
                            <span class="mdi mdi-file-document-outline"></span> Rekap Absen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
