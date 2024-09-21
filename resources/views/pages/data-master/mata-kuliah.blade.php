@extends('layouts.main')
@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <span class="mdi mdi-plus"></span> Tambah
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Kode </th>
                                            <th> Nama Matkul </th>
                                            <th> Prodi </th>
                                            <th> Semester </th>
                                            <th> SKS </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>APS</td>
                                            <td>Aplikasi Server</td>
                                            <td>Teknik Informatika</td>
                                            <td>Semester 2</td>
                                            <td>2</td>
                                            <td>
                                                <a href="" class="btn btn-primary btn-sm"><span
                                                        class="mdi mdi-pencil"></span> Edit</a>
                                                <form action="/delete/1" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        <span class="mdi mdi-delete"></span> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>MTKB</td>
                                            <td>Matematika Bisnis</td>
                                            <td>Akuntansi</td>
                                            <td>Semester 2</td>
                                            <td>2</td>
                                            <td>
                                                <a href="" class="btn btn-primary btn-sm"><span
                                                        class="mdi mdi-pencil"></span> Edit</a>
                                                <form action="/delete/1" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        <span class="mdi mdi-delete"></span> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bootstrap untuk Tambah Data -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Mata kuliah</label>
                            <input type="text" class="form-control" id="kode" name="kode" required
                                placeholder="Kode mata kuliah">
                        </div>
                        <div class="mb-3">
                            <label for="namaKelas" class="form-label">Nama Mata kuliah</label>
                            <input type="text" class="form-control" id="namaKelas" name="nama" required
                                placeholder="Nama mata kuliah">
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-control" id="semester">
                                <option selected>--Semester--</option>
                                <option>Semester 1</option>
                                <option>Semester 3</option>
                                <option>Semester 5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sks" class="form-label">Gender</label>
                            <select class="form-control" id="sks">
                                <option selected>--SKS--</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="mdi mdi-content-save"></span> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
