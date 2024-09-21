@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <span class="mdi mdi-plus"></span> Tambah
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Dosen</th>
                                            <th>Mata Kulaih</th>
                                            <th>Kelas</th>
                                            <th>Tahun Ajaran[Semester]</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Damar Eko Cahyono S.T.,M.M</td>
                                            <td>Aplikasi Server</td>
                                            <td>LS.1.1</td>
                                            <td>2024/2025 [Semseter 2]</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#showModal">
                                                    <span class="mdi mdi-information-variant"></span> Detail
                                                </button>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    onclick="editData('Damar Eko Cahyono S.T.,M.M')">
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal Mengajar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode Jadwal</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan kode" id="kode">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="tahunAjaran" class="form-label">Tahun Ajaran</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan kode" id="tahunAjaran" disabled
                                                            value="2024/2025">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <select class="form-control" id="semester">
                                                            <option selected>--Semester--</option>
                                                            <option>Semester 1</option>
                                                            <option>Semester 3</option>
                                                            <option>Semester 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="matkul" class="form-label">Mata kuliah</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan mata kuliah" id="matkul">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="dosen" class="form-label">Dosen</label>
                                                        <select class="form-control" id="dosen">
                                                            <option selected>--Dosen--</option>
                                                            <option>Dosen 1</option>
                                                            <option>Dosen 3</option>
                                                            <option>Dosen 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Program Studi</label>
                                                        <select class="form-control" id="prodi">
                                                            <option selected>--Program Studi--</option>
                                                            <option>Prodi 1</option>
                                                            <option>Prodi 3</option>
                                                            <option>Prodi 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Pilih Hari</label>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Senin </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Selasa </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Rabu </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Kamis </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Jum'at </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="sks" class="form-label">SKS</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan mata kuliah" id="sks" disabled
                                                            value="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="kelas" class="form-label">Kelas</label>
                                                        <select class="form-control" id="kelas">
                                                            <option selected>--Kelas--</option>
                                                            <option>Kelas 1</option>
                                                            <option>Kelas 3</option>
                                                            <option>Kelas 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="ruangan" class="form-label">Ruangan</label>
                                                        <select class="form-control" id="ruangan">
                                                            <option selected>--Ruangan--</option>
                                                            <option>Ruangan 1</option>
                                                            <option>Ruangan 3</option>
                                                            <option>Ruangan 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jamMulai" class="form-label">Jam Mulai</label>
                                                        <input type="time" class="form-control"
                                                            placeholder="Jam Mulai" id="jamMulai">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jamSelesai" class="form-label">Jam Selesai</label>
                                                        <input type="time" class="form-control"
                                                            placeholder="Jam Selesai" id="jamSelesai">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="mdi mdi-content-save"></span> Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Bootstrap untuk Show Data -->
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel">Detail Jadwal Mengajar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th><span class="mdi mdi-barcode"></span> Kode Jadwal</th>
                                    <td>1010101</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-calendar-range"></span> Tahun Ajaran</th>
                                    <td>2024/2025</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-school"></span> Semester</th>
                                    <td>Semester 3</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-book-open-blank-variant"></span> Mata Kuliah</th>
                                    <td>Aplikasi</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-human-male-board"></span> Dosen</th>
                                    <td>Dosen 1</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-book"></span> Prodi</th>
                                    <td>Teknik Informatika</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-calendar-range"></span> Hari</th>
                                    <td>Senin</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-format-list-numbered"></span> SKS</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th><span class="mdi mdi-clock-outline"></span> Jam</th>
                                    <td>08.40-11.30</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Modal Bootstrap untuk Edit Data -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Jadwal Mengajar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode Jadwal</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan kode" id="kode">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="tahunAjaran" class="form-label">Tahun Ajaran</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan kode" id="tahunAjaran" disabled
                                                            value="2024/2025">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <select class="form-control" id="semester">
                                                            <option selected>--Semester--</option>
                                                            <option>Semester 1</option>
                                                            <option>Semester 3</option>
                                                            <option>Semester 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="matkul" class="form-label">Mata kuliah</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan mata kuliah" id="matkul">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="dosen" class="form-label">Dosen</label>
                                                        <select class="form-control" id="dosen">
                                                            <option selected>--Dosen--</option>
                                                            <option>Dosen 1</option>
                                                            <option>Dosen 3</option>
                                                            <option>Dosen 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Program Studi</label>
                                                        <select class="form-control" id="prodi">
                                                            <option selected>--Program Studi--</option>
                                                            <option>Prodi 1</option>
                                                            <option>Prodi 3</option>
                                                            <option>Prodi 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Pilih Hari</label>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Senin </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Selasa </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Rabu </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Kamis </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-2">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input"
                                                                                name="optionsRadios" id="optionsRadios1"
                                                                                value="">
                                                                            Jum'at </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="sks" class="form-label">SKS</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan mata kuliah" id="sks" disabled
                                                            value="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="kelas" class="form-label">Kelas</label>
                                                        <select class="form-control" id="kelas">
                                                            <option selected>--Kelas--</option>
                                                            <option>Kelas 1</option>
                                                            <option>Kelas 3</option>
                                                            <option>Kelas 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="ruangan" class="form-label">Ruangan</label>
                                                        <select class="form-control" id="ruangan">
                                                            <option selected>--Ruangan--</option>
                                                            <option>Ruangan 1</option>
                                                            <option>Ruangan 3</option>
                                                            <option>Ruangan 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jamMulai" class="form-label">Jam Mulai</label>
                                                        <input type="time" class="form-control"
                                                            placeholder="Jam Mulai" id="jamMulai">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jamSelesai" class="form-label">Jam Selesai</label>
                                                        <input type="time" class="form-control"
                                                            placeholder="Jam Selesai" id="jamSelesai">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="mdi mdi-content-save"></span> Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function editData(dosen) {
                document.getElementById('dosen').value = dosen;
            }
        </script>
    @endsection
