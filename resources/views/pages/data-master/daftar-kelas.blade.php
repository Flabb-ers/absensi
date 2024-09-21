@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                <span class="mdi mdi-plus"></span> Tambah
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Nama Kelas </th>
                                            <th> Semester </th>
                                            <th> Jenis Kelas </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody id="kelasTable">
                                        @foreach($kelass as $item)
                                            <tr id="row_{{ $item->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kelas }}</td>
                                                <td>Semester {{ $item->semester->semester }}</td>
                                                <td>{{ $item->jenis_kelas }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm editKelas" data-id="{{ $item->id }}">
                                                        <span class="mdi mdi-pencil"></span> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm deleteKelas" data-id="{{ $item->id }}">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
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
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="namaProdi" class="form-label">Program Studi</label>
                            <select class="form-control" id="namaProdi" name="id_prodi" required>
                                <option selected disabled>--Program Studi--</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-control" id="semester" name="id_semester" required>
                                <option selected disabled>--Semester--</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">Semester {{ $semester->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelas" class="form-label">Jenis Kelas</label>
                            <select class="form-control" id="jenisKelas" name="jenis_kelas" required>
                                <option selected disabled>--Jenis Kelas--</option>
                                <option value="Reguler">Reguler</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="mdi mdi-content-save"></span> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    // Setup CSRF token untuk setiap request (ini penting jika menggunakan Laravel)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit form untuk menambah kelas
    $('#tambahForm').submit(function(e) {
        e.preventDefault();

        // Ambil nilai input dari form
        let idProdi = $('#namaProdi').val();
        let idSemester = $('#semester').val();
        let jenisKelas = $('#jenisKelas').val();

        // Reset error sebelumnya jika ada
        $('#namaProdi').removeClass('is-invalid');
        $('#semester').removeClass('is-invalid');
        $('#jenisKelas').removeClass('is-invalid');
        $('#errorProdi').text('');
        $('#errorSemester').text('');
        $('#errorJenisKelas').text('');

        // AJAX request
        $.ajax({
            url: '{{ route('daftar-kelas.store') }}', // URL action untuk request POST
            method: 'POST', // Method yang digunakan
            data: {
                id_prodi: idProdi,
                id_semester: idSemester,
                jenis_kelas: jenisKelas
            },
            success: function(response) {
                // Tambahkan kelas baru ke tabel atau refresh halaman
                $('#kelasTable').append(`
                    <tr id="row_${response.kelas.id}">
                        <td>${response.kelas.id}</td>
                        <td>${response.kelas.nama_kelas}</td>
                        <td>Semester ${response.kelas.semester.semester}</td>
                        <td>${response.kelas.jenis_kelas}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm editKelas" data-id="${response.kelas.id}">
                                <span class="mdi mdi-pencil"></span> Edit
                            </a>
                            <button class="btn btn-danger btn-sm deleteKelas" data-id="${response.kelas.id}">
                                <span class="mdi mdi-delete"></span> Hapus
                            </button>
                        </td>
                    </tr>
                `);

                // Tutup modal
                $('#tambahModal').modal('hide');
                $('#tambahForm')[0].reset();

                // Tampilkan notifikasi sukses menggunakan SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response.success,
                    confirmButtonText: 'Oke'
                });
            },
            error: function(response) {
                if (response.status === 422) {
                    // Jika ada validasi error dari server
                    const errors = response.responseJSON.errors;
                    
                    // Tampilkan error untuk setiap field
                    if (errors.id_prodi) {
                        $('#namaProdi').addClass('is-invalid');
                        $('#errorProdi').text(errors.id_prodi[0]);
                    }
                    if (errors.id_semester) {
                        $('#semester').addClass('is-invalid');
                        $('#errorSemester').text(errors.id_semester[0]);
                    }
                    if (errors.jenis_kelas) {
                        $('#jenisKelas').addClass('is-invalid');
                        $('#errorJenisKelas').text(errors.jenis_kelas[0]);
                    }
                } else {
                    // Jika ada error lain
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                    });
                }
            }
        });
    });
});

    </script>
@endsection
