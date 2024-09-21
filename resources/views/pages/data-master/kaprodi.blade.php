@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <span class="mdi mdi-plus"></span> Tambah
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Prodi</th>
                                            <th>Nama Kaprodi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Teknik Informatika</td>
                                            <td>Damar Eko Cahyono S.T.,M.M</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" 
                                                    onclick="editData('Teknik Informatika', 'Damar Eko Cahyono S.T.,M.M')">
                                                    <span class="mdi mdi-pencil"></span> Edit
                                                </button>

                                                <form style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>
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
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Kaprodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tambahForm" action="/tambah-kelas" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="semester" class="form-label">Nama Dosen</label>
                                <select class="form-control" id="semester" name="semester">
                                    <option selected>--Nama Dosen--</option>
                                    <option>Damar Eko Cahyono</option>
                                    <option>Kawan pak damar</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">Gender</label>
                                <select class="form-control" id="sks" name="sks">
                                    <option selected>--Program Studi--</option>
                                    <option>Teknik Informatika</option>
                                    <option>Akuntansi</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="mdi mdi-content-save"></span> Simpan
                            </button>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Kaprodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            @csrf
                            <div class="mb-3">
                                <label for="semester" class="form-label">Nama Dosen</label>
                                <select class="form-control" id="semester">
                                    <option selected>--Nama Dosen--</option>
                                    <option>Damar Eko Cahyono</option>
                                    <option>Kawan pak damar</option>
                                    <option>Semester 5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">Gender</label>
                                <select class="form-control" id="sks" name="sks">
                                    <option selected>--Program Studi--</option>
                                    <option>Teknik Informatika</option>
                                    <option>Akuntansi</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="mdi mdi-content-save"></span> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>
        function editData(id, prodi, namaKaprodi) {
            document.getElementById('editProdi').value = prodi;
            document.getElementById('editNamaKaprodi').value = namaKaprodi;
        }
    </script>
@endsection
