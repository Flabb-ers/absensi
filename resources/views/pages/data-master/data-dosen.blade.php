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
                                            <th>NIDN</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dosens as $dosen)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dosen->nama }}</td>
                                                <td>{{ $dosen->nidn }}</td>
                                                <td>{{ $dosen->jenis_kelamin }}</td>
                                                @if ($dosen->status == 1)
                                                    <td><span class="bg-success rounded"
                                                            style="width: 15px; height: 15px; display: inline-block;"></span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="bg-danger rounded"
                                                            style="width: 15px; height: 15px; display: inline-block;"></span>
                                                    </td>
                                                @endif
                                                <td>{{ $dosen->email }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" onclick="showDetail(this)"
                                                        data-nama="{{ $dosen->nama }}" data-nidn="{{ $dosen->nidn }}"
                                                        data-jenis-kelamin="{{ $dosen->jenis_kelamin }}"
                                                        data-no-telephone="{{ $dosen->no_telephone }}"
                                                        data-agama="{{ $dosen->agama }}"
                                                        data-tanggal-lahir="{{ $dosen->tanggal_lahir }}"
                                                        data-tempat-lahir="{{ $dosen->tempat_lahir }}"
                                                        data-email="{{ $dosen->email }}"
                                                        data-status="{{ $dosen->status }}">
                                                        <span class="mdi mdi-eye"></span> Lihat Detail
                                                    </button>

                                                    <button class="btn btn-primary btn-sm edit-button"
                                                        data-id="{{ $dosen->id }}" data-nama="{{ $dosen->nama }}"
                                                        data-nidn="{{ $dosen->nidn }}"
                                                        data-jenis_kelamin="{{ $dosen->jenis_kelamin }}"
                                                        data-no_telephone="{{ $dosen->no_telephone }}"
                                                        data-agama="{{ $dosen->agama }}"
                                                        data-tanggal_lahir="{{ $dosen->tanggal_lahir }}"
                                                        data-tempat_lahir="{{ $dosen->tempat_lahir }}"
                                                        data-email="{{ $dosen->email }}"
                                                        data-status="{{ $dosen->status }}">
                                                        <span class="mdi mdi-pencil"></span> Edit
                                                    </button>


                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="deleteDosen({{ $dosen->id }}, '{{ $dosen->nama }}')">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="7">Dosen belum ditambahkan</td>
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


    {{-- tambah --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Dosen</h5>
                    <button type="button" class="btn-close close-tambah" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Nama Dosen" autocomplete="off">
                            <div id="namaError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="number" class="form-control" id="nidn" name="nidn" placeholder="NIDN"
                                autocomplete="off">
                            <div id="nidnError" class="invalid-feedback"></div>
                        </div>
                        <div>
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="d-flex flex-wrap">
                                <div class="form-group me-3">
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label" for="jenis_kelamin_1">
                                            <input type="radio" class="form-check-input" value="Laki-Laki"
                                                name="jenis_kelamin" id="jenis_kelamin_1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group me-3">
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label" for="jenis_kelamin_2">
                                            <input type="radio" class="form-check-input" value="Perempuan"
                                                name="jenis_kelamin" id="jenis_kelamin_2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_telephone" class="form-label">Nomor WhatsApp Aktif</label>
                            <input type="text" class="form-control" id="no_telephone" name="no_telephone"
                                placeholder="Nomor WhatsApp" autocomplete="off">
                            <div id="noTelephoneError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" id="agama" name="agama">
                                <option selected disabled>--Agama--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Budha">Budha</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            <div id="agamaError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                placeholder="Tanggal Lahir" autocomplete="off">
                            <div id="tanggalLahirError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                placeholder="Tempat Lahir" autocomplete="off">
                            <div id="tempatLahirError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email" autocomplete="off">
                            <div id="emailError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off">
                            <div id="passwordError" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="mdi mdi-content-save"></span> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Dosen</h5>
                    <button type="button" class="btn-close close-edit" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        <input type="hidden" id="dosen_id" name="id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="namaEdit" name="nama"
                                placeholder="Nama Dosen">
                            <div id="namaErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="number" class="form-control" id="nidnEdit" name="nidn"
                                placeholder="NIDN">
                            <div id="nidnErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div>
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="d-flex flex-wrap">
                                <div class="form-group me-3">
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label" for="jenis_kelamin_1Edit">
                                            <input type="radio" class="form-check-input" value="Laki-Laki"
                                                name="jenis_kelaminEdit" id="jenis_kelamin_1Edit">
                                            Laki-Laki
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group me-3">
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label" for="jenis_kelamin_2Edit">
                                            <input type="radio" class="form-check-input" value="Perempuan"
                                                name="jenis_kelaminEdit" id="jenis_kelamin_2Edit">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_telephone" class="form-label">Nomor WhatsApp Aktif</label>
                            <input type="text" class="form-control" id="no_telephoneEdit" name="no_telephone"
                                placeholder="Nomor WhatsApp">
                            <div id="noTelephoneErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" id="agamaEdit" name="agama">
                                <option selected disabled>--Agama--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Budha">Budha</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            <div id="agamaErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahirEdit" name="tanggal_lahir"
                                placeholder="Tanggal Lahir">
                            <div id="tanggalLahirErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahirEdit" name="tempat_lahir"
                                placeholder="Tempat Lahir">
                            <div id="tempatLahirErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailEdit" name="email"
                                placeholder="Email">
                            <div id="emailErrorEdit" class="invalid-feedback"></div>
                        </div>
                        <label class="form-label">Status</label><br>
                        <div class="d-flex flex-wrap">
                            <div class="form-group me-3">
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label" for="status_aktifEdit">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="status_aktifEdit" value="1">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            <div class="form-group me-3">
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label" for="status_non_aktifEdit">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="status_non_aktifEdit" value="0">
                                        Non-Aktif
                                    </label>
                                </div>
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


    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nama: </strong><span id="detailNama"></span></li>
                        <li class="list-group-item"><strong>NIDN: </strong><span id="detailNidn"></span></li>
                        <li class="list-group-item"><strong>Jenis Kelamin: </strong><span id="detailJenisKelamin"></span>
                        </li>
                        <li class="list-group-item"><strong>No. Telephone: </strong><span id="detailNoTelephone"></span>
                        </li>
                        <li class="list-group-item"><strong>Agama: </strong><span id="detailAgama"></span></li>
                        <li class="list-group-item"><strong>Tanggal Lahir: </strong><span id="detailTanggalLahir"></span>
                        </li>
                        <li class="list-group-item"><strong>Tempat Lahir: </strong><span id="detailTempatLahir"></span>
                        </li>
                        <li class="list-group-item"><strong>Email: </strong><span id="detailEmail"></span></li>
                        <li class="list-group-item"><strong>Status: </strong><span id="detailStatus"></span></li>
                    </ul>
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

            $('#tambahForm').submit(function(e) {
                e.preventDefault();

                $('input, select, textarea').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                let nama = $('#nama').val();
                let nidn = $('#nidn').val();
                let jenis_kelamin = $('input[name="jenis_kelamin"]:checked').val();
                let no_telephone = $('#no_telephone').val();
                let agama = $('#agama').val();
                let tanggal_lahir = $('#tanggal_lahir').val();
                let tempat_lahir = $('#tempat_lahir').val();
                let email = $('#email').val();
                let password = $('#password').val();

                $('#namaError, #nidnError, #noTelephoneError, #agamaError, #tanggalLahirError, #tempatLahirError, #emailError, #passwordError')
                    .text('').removeClass('is-invalid');

                $.ajax({
                    url: '{{ route('data-dosen.store') }}',
                    method: 'POST',
                    data: {
                        nama: nama,
                        nidn: nidn,
                        jenis_kelamin: jenis_kelamin,
                        no_telephone: no_telephone,
                        agama: agama,
                        tanggal_lahir: tanggal_lahir,
                        tempat_lahir: tempat_lahir,
                        email: email,
                        password: password
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
                            if (errors.nama) {
                                $('#nama').addClass('is-invalid');
                                $('#namaError').text(errors.nama[0]);
                            }
                            if (errors.nidn) {
                                $('#nidn').addClass('is-invalid');
                                $('#nidnError').text(errors.nidn[0]);
                            }
                            if (errors.no_telephone) {
                                $('#no_telephone').addClass('is-invalid');
                                $('#noTelephoneError').text(errors.no_telephone[0]);
                            }
                            if (errors.agama) {
                                $('#agama').addClass('is-invalid');
                                $('#agamaError').text(errors.agama[0]);
                            }
                            if (errors.tanggal_lahir) {
                                $('#tanggal_lahir').addClass('is-invalid');
                                $('#tanggalLahirError').text(errors.tanggal_lahir[
                                    0]);
                            }
                            if (errors.tempat_lahir) {
                                $('#tempat_lahir').addClass('is-invalid');
                                $('#tempatLahirError').text(errors.tempat_lahir[0]);
                            }
                            if (errors.email) {
                                $('#email').addClass('is-invalid');
                                $('#emailError').text(errors.email[0]);
                            }
                            if (errors.password) {
                                $('#password').addClass('is-invalid');
                                $('#passwordError').text(errors.password[0]);
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

            $(document).on('click', '.edit-button', function() {
                $('#editForm')[0].reset();
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let nidn = $(this).data('nidn');
                let jenis_kelamin = $(this).data('jenis_kelamin');
                let no_telephone = $(this).data('no_telephone');
                let agama = $(this).data('agama');
                let tanggal_lahir = $(this).data('tanggal_lahir');
                let tempat_lahir = $(this).data('tempat_lahir');
                let email = $(this).data('email');
                let status = $(this).data('status');

                $('#dosen_id').val(id);
                $('#namaEdit').val(nama);
                $('#nidnEdit').val(nidn);
                $('#no_telephoneEdit').val(no_telephone);
                $('#agamaEdit').val(agama).change();
                $('#tanggal_lahirEdit').val(tanggal_lahir);
                $('#tempat_lahirEdit').val(tempat_lahir);
                $('#emailEdit').val(email);
                $(`input[name="jenis_kelaminEdit"][value="${jenis_kelamin}"]`).prop('checked', true);
                $('input[name="status"][value="' + status + '"]').prop('checked', true);
                $('#editModal').modal('show');

            });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#dosen_id').val();
                let nama = $('#namaEdit').val();
                let nidn = $('#nidnEdit').val();
                let no_telephone = $('#no_telephoneEdit').val();
                let agama = $('#agamaEdit').val();
                let tanggal_lahir = $('#tanggal_lahirEdit').val();
                let tempat_lahir = $('#tempat_lahirEdit').val();
                let email = $('#emailEdit').val();
                let status = $('input[name="status"]:checked').val();
                let jenis_kelamin = $('input[name="jenis_kelaminEdit"]:checked').val();

                $.ajax({
                    url: '{{ route('data-dosen.update', ':id') }}'.replace(':id', id),
                    method: 'PUT',
                    data: {
                        nama: nama,
                        nidn: nidn,
                        jenis_kelamin: jenis_kelamin,
                        no_telephone: no_telephone,
                        agama: agama,
                        tanggal_lahir: tanggal_lahir,
                        tempat_lahir: tempat_lahir,
                        email: email,
                        status: status
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

                            if (errors.nama) {
                                $('#namaEdit').addClass('is-invalid');
                                $('#namaErrorEdit').text(errors.nama[0]);
                            }
                            if (errors.nidn) {
                                $('#nidnEdit').addClass('is-invalid');
                                $('#nidnErrorEdit').text(errors.nidn[0]);
                            }
                            if (errors.no_telephone) {
                                $('#no_telephoneEdit').addClass('is-invalid');
                                $('#noTelephoneErrorEdit').text(errors.no_telephone[0]);
                            }
                            if (errors.agama) {
                                $('#agamaEdit').addClass('is-invalid');
                                $('#agamaErrorEdit').text(errors.agama[0]);
                            }
                            if (errors.tanggal_lahir) {
                                $('#tanggal_lahirEdit').addClass('is-invalid');
                                $('#tanggalLahirErrorEdit').text(errors.tanggal_lahir[0]);
                            }
                            if (errors.tempat_lahir) {
                                $('#tempat_lahirEdit').addClass('is-invalid');
                                $('#tempatLahirErrorEdit').text(errors.tempat_lahir[0]);
                            }
                            if (errors.email) {
                                $('#emailEdit').addClass('is-invalid');
                                $('#emailErrorEdit').text(errors.email[0]);
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
        });

        function showDetail(button) {
            const nama = button.getAttribute('data-nama');
            const nidn = button.getAttribute('data-nidn');
            const jenisKelamin = button.getAttribute('data-jenis-kelamin');
            const noTelephone = button.getAttribute('data-no-telephone');
            const agama = button.getAttribute('data-agama');
            const tanggalLahir = button.getAttribute('data-tanggal-lahir');
            const tempatLahir = button.getAttribute('data-tempat-lahir');
            const email = button.getAttribute('data-email');
            const status = button.getAttribute('data-status') == 1 ? 'Aktif' : 'Non-Aktif';

            // Set data ke elemen di modal
            $('#detailNama').text(nama);
            $('#detailNidn').text(nidn);
            $('#detailJenisKelamin').text(jenisKelamin);
            $('#detailNoTelephone').text(noTelephone);
            $('#detailAgama').text(agama);
            $('#detailTanggalLahir').text(tanggalLahir);
            $('#detailTempatLahir').text(tempatLahir);
            $('#detailEmail').text(email);
            $('#detailStatus').text(status);

            // Tampilkan modal
            $('#detailModal').modal('show');
        }

        function deleteDosen(id, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Dosen " + nama + " akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('data-dosen.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dihapus!',
                                text: 'Dosen ' + nama + ' telah dihapus.',
                                confirmButtonText: 'Oke'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus data.',
                            });
                        }
                    });
                }
            });
        }
        $('.close-tambah').on('click', function() {
            $('#tambahForm')[0].reset();
            $('#tambahForm .form-control').removeClass('is-invalid');
            $('#namaError').text('');
            $('#nidnError').text('');
            $('#noTelephoneError').text('');
            $('#agamaError').text('');
            $('#tanggalLahirError').text('');
            $('#tempatLahirError').text('');
            $('#emailError').text('');
            $('#passwordError').text('');
        });

        $('.close-edit').on('click', function() {
            $('#editForm')[0].reset();
            $('#editForm .form-control').removeClass('is-invalid');
            $('#namaErrorEdit').text('');
            $('#nidnErrorEdit').text('');
            $('#noTelephoneErrorEdit').text('');
            $('#agamaErrorEdit').text('');
            $('#tanggalLahirErrorEdit').text('');
            $('#tempatLahirErrorEdit').text('');
            $('#emailErrorEdit').text('');
        });
    </script>
@endsection
