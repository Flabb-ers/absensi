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
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Semester</th>
                                            <th>Prodi</th>
                                            <th>Ruangan</th>
                                            <th>Dosen</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($matkuls as $matkul)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $matkul->nama_matkul }}</td>
                                                <td>{{ $matkul->kelas->nama_kelas }}</td>
                                                <td>Semester {{ $matkul->kelas->semester->semester }}</td>
                                                <td>{{ $matkul->kelas->prodi->nama_prodi }}</td>
                                                <td>{{ $matkul->ruangan->nama }}</td>
                                                <td>{{ $matkul->dosen->nama }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm editMatkul"
                                                        data-id="{{ $matkul->id }}" data-nama="{{ $matkul->nama_matkul }}"
                                                        data-sks="{{ $matkul->sks }}" data-kelas="{{ $matkul->kelas_id }}"
                                                        data-dosen="{{ $matkul->dosens_id }}"
                                                        data-ruangan="{{ $matkul->ruangans_id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editModal">
                                                        <span class="mdi mdi-pencil"></span> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-button deleteMatkul"
                                                        data-id="{{ $matkul->id }}" data-nama="{{ $matkul->nama_matkul }}">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="7">Matkul belum ditambahkan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama_matkul" class="form-label">Nama Mata kuliah</label>
                                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul"
                                    placeholder="Nama Mata Kuliah">
                                <div id="namaMatkulError" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sks" class="form-label">Nama Mata kuliah</label>
                                <input type="number" class="form-control" id="sks" name="sks" placeholder="SKS">
                                <div id="sksError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="nama" class="form-label">Dosen</label>
                                <select class="form-control" id="nama" name="nama">
                                    <option selected value="">--Dosen--</option>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                                <div id="dosenError" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-control" id="ruangan" name="ruangan">
                                    <option selected value="">--Ruangan--</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                                    @endforeach
                                </select>
                                <div id="ruanganError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas_id">
                                    <option selected value="">--Kelas--</option>
                                    @foreach ($kelass as $kelas)
                                        <option value="{{ $kelas->id }}"
                                            data-semester="{{ $kelas->semester->semester }}"
                                            data-prodi="{{ $kelas->prodi->nama_prodi }}"
                                            data-jenis-kelas="{{ $kelas->jenis_kelas }}">{{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="kelasError" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="semester" class="form-label">Semester</label>
                                <div id="semester" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="program_studi" class="form-label">Prodi</label>
                                <div id="program_studi" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="jenis_kelas" class="form-label">Jenis Kelas</label>
                                <div id="jenis_kelas" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="mdi mdi-content-save"></span> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">
                        <div class="row">
                            <div class="mb-3 col-md-3 col-md-6">
                                <label for="edit_nama_matkul" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="edit_nama_matkul" name="nama_matkul">
                                <div id="editNamaMatkulError" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="edit_sks" class="form-label">SKS</label>
                                <input type="number" class="form-control" id="edit_sks" name="sks">
                                <div id="editSksError" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="edit_kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="edit_kelas" name="kelas_id">
                                    @foreach ($kelass as $kelas)
                                        <option value="{{ $kelas->id }}"
                                            data-semester="{{ $kelas->semester->semester }}"
                                            data-prodi="{{ $kelas->prodi->nama_prodi }}"
                                            data-jenis-kelas="{{ $kelas->jenis_kelas }}">
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="editKelasError" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="edit_semester" class="form-label">Semester</label>
                                <div id="edit_semester" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="edit_program_studi" class="form-label">Prodi</label>
                                <div id="edit_program_studi" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="edit_jenis_kelas" class="form-label">Jenis Kelas</label>
                                <div id="edit_jenis_kelas" class="form-control" readonly
                                    style="background-color: #f8f9fa; cursor: not-allowed;"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="edit_dosen" class="form-label">Dosen</label>
                                <select class="form-control" id="edit_dosen" name="dosens_id">
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                                <div id="editDosenError" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="edit_ruangan" class="form-label">Ruangan</label>
                                <select class="form-control" id="edit_ruangan" name="ruangans_id">
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                                    @endforeach
                                </select>
                                <div id="editRuanganError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="mdi mdi-content-save"></span> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#kelas').change(function() {

                var selectedOption = $(this).find('option:selected');
                var semester = selectedOption.data('semester');
                var prodi = selectedOption.data('prodi');
                var jenisKelas = selectedOption.data(
                    'jenis-kelas')

                $('#semester').text('Semester ' + semester);
                $('#program_studi').text(prodi);
                $('#jenis_kelas').text(jenisKelas);
            });
            $('#tambahForm').submit(function(e) {
                e.preventDefault();

                $('input, select, textarea').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                let nama_matkul = $('#nama_matkul').val();
                let sks = $('#sks').val();
                let dosen_id = $('#nama').val();
                let ruangan_id = $('#ruangan').val();
                let kelas_id = $('#kelas').val();

                $('#namaMatkulError, #sksError, #dosenError, #ruanganError, #kelasError')
                    .text('').removeClass('is-invalid');

                $.ajax({
                    url: '{{ route('mata-kuliah.store') }}',
                    method: 'POST',
                    data: {
                        nama_matkul: nama_matkul,
                        sks: sks,
                        dosens_id: dosen_id,
                        ruangans_id: ruangan_id,
                        kelas_id: kelas_id
                    },
                    success: function(response) {
                        $('#tambahModal').modal('hide');
                        $('#tambahForm')[0].reset();

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.success,
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            const errors = response.responseJSON.errors;
                            if (errors.nama_matkul) {
                                $('#nama_matkul').addClass('is-invalid');
                                $('#namaMatkulError').text(errors.nama_matkul[0]);
                            }
                            if (errors.sks) {
                                $('#sks').addClass('is-invalid');
                                $('#sksError').text(errors.sks[0]);
                            }
                            if (errors.dosens_id) {
                                $('#nama').addClass('is-invalid');
                                $('#dosenError').text(errors.dosens_id[0]);
                            }
                            if (errors.ruangans_id) {
                                $('#ruangan').addClass('is-invalid');
                                $('#ruanganError').text(errors.ruangans_id[0]);
                            }
                            if (errors.kelas_id) {
                                $('#kelas').addClass('is-invalid');
                                $('#kelasError').text(errors.kelas_id[0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.editMatkul', function() {

                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var sks = $(this).data('sks');
                var kelas = $(this).data('kelas');
                var dosen = $(this).data('dosen');
                var ruangan = $(this).data('ruangan');


                $('#editId').val(id);
                $('#edit_nama_matkul').val(nama);
                $('#edit_sks').val(sks);
                $('#edit_kelas').val(kelas);
                $('#edit_dosen').val(dosen);
                $('#edit_ruangan').val(ruangan);

                $('#edit_kelas').trigger('change');
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                $('input, select').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                var id = $('#editId').val();
                var namaMatkul = $('#edit_nama_matkul').val();
                var sks = $('#edit_sks').val();
                var dosenId = $('#edit_dosen').val();
                var ruanganId = $('#edit_ruangan').val();
                var kelasId = $('#edit_kelas').val();

                $.ajax({
                    url: '{{ route('mata-kuliah.update', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: {
                        nama_matkul: namaMatkul,
                        sks: sks,
                        dosen_id: dosenId,
                        ruangan_id: ruanganId,
                        kelas_id: kelasId
                    },
                    success: function(response) {
                        $('#editModal').modal('hide');
                        $('#editForm')[0].reset();

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.success,
                            confirmButtonText: 'Oke'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            const errors = response.responseJSON.errors;
                            if (errors.nama_matkul) {
                                $('#edit_nama_matkul').addClass('is-invalid');
                                $('#editNamaMatkulError').text(errors.nama_matkul[0]);
                            }
                            if (errors.sks) {
                                $('#edit_sks').addClass('is-invalid');
                                $('#editSksError').text(errors.sks[0]);
                            }
                            if (errors.dosen_id) {
                                $('#edit_dosen').addClass('is-invalid');
                                $('#dosenError').text(errors.dosen_id[0]);
                            }
                            if (errors.ruangan_id) {
                                $('#edit_ruangan').addClass('is-invalid');
                                $('#ruanganError').text(errors.ruangan_id[0]);
                            }
                            if (errors.kelas_id) {
                                $('#edit_kelas').addClass('is-invalid');
                                $('#kelasError').text(errors.kelas_id[0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                            });
                        }
                    }
                });
            });

            $('#edit_kelas').change(function() {
                var selectedOption = $(this).find('option:selected');
                var semester = selectedOption.data('semester');
                var prodi = selectedOption.data('prodi');
                var jenisKelas = selectedOption.data('jenis-kelas');

                $('#edit_semester').text('Semester ' + semester);
                $('#edit_program_studi').text(prodi);
                $('#edit_jenis_kelas').text(jenisKelas);
            });

            $(document).on('click', '.deleteMatkul', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus mata kuliah " + nama,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('mata-kuliah.destroy', ':id') }}'.replace(':id', id),
                            method: 'DELETE',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: response.success,
                                    confirmButtonText: 'Oke'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat menghapus mata kuliah.',
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
