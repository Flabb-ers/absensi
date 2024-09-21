@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <span class="mdi mdi-plus"></span> Tambah
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> NIP </th>
                                            <th> Nama Dosen </th>
                                            <th> Email </th>
                                            <th> Foto </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>101010101010</td>
                                            <td>Kawan Pak damar</td>
                                            <td>kawan@email.com</td>
                                            <td><img src="{{ asset('/images/faces/face1.jpg') }}" alt=""></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" 
                                                    onclick="editData()">
                                                    <span class="mdi mdi-pencil"></span> Edit
                                                </button>
                                                <form action="/delete/1" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        <span class="mdi mdi-delete"></span> Hapus</button>
                                                </form>
                                            </td>
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
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tambahForm">
                            @csrf
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP/NUPTK</label>
                                <input type="number" class="form-control" id="nip" required placeholder="NIP/NUPTK">
                            </div>
                            <div class="mb-3">
                                <label for="namaDosen" class="form-label">Nama Dosen</label>
                                <input type="text" class="form-control" id="namaDosen" required
                                    placeholder="Nama direktur">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" required placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="gambar" required placeholder="Gambar">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="mdi mdi-content-save"></span> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Bootstrap untuk Edit Data -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            @csrf
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP/NUPTK</label>
                                <input type="number" class="form-control" id="nip" required placeholder="NIP/NUPTK">
                            </div>
                            <div class="mb-3">
                                <label for="namaDirektur" class="form-label">Nama Dosen</label>
                                <input type="text" class="form-control" id="namaDirektur" required
                                    placeholder="Nama direktur">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" required placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label d-block">Foto</label>
                                <img src="{{ asset('/images/faces/face1.jpg') }}" alt="" class="mb-3 rounded  d-block">
                                <input type="file" class="form-control" id="gambar" required placeholder="Gambar">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="mdi mdi-content-save"></span> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
