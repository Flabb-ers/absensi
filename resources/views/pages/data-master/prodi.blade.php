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
                                            <th> Kode Prodi </th>
                                            <th> Nama Prodi </th>
                                            <th> Singkatan </th>
                                            <th> Jenjang </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($prodis as $prodi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->kode_prodi }}</td>
                                                <td>{{ $prodi->nama_prodi }}</td>
                                                <td>{{ $prodi->singkatan }}</td>
                                                <td>{{ $prodi->jenjang }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm edit-btn"
                                                        data-id="{{ $prodi->id }}" data-kode="{{ $prodi->kode_prodi }}"
                                                        data-nama="{{ $prodi->nama_prodi }}"
                                                        data-singkatan="{{ $prodi->singkatan }}"
                                                        data-jenjang="{{ $prodi->jenjang }}" data-toggle="modal"
                                                        data-target="#editModal">Edit</button>
                                                    <form id="delete-form-{{ $prodi->id }}"
                                                        action="{{ route('prodi.destroy', $prodi->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete('{{ $prodi->id }}')">
                                                            <span class="mdi mdi-delete"></span> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Prodi belum ditambahkan</td>
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

    <!-- Modal Bootstrap untuk Tambah Data -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Prodi</h5>
                    <button type="button" class="btn-close-tambah btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="kodeProdi" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" id="kodeProdi" name="kode_prodi" required
                                placeholder="Kode prodi">
                            <div id="kodeError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="namaProdi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="namaProdi" name="nama_prodi" required
                                placeholder="Nama prodi">
                            <div id="namaError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="singkatan" class="form-label">Singkatan</label>
                            <input type="text" class="form-control" id="singkatan" name="singkatan" required
                                placeholder="Singkatan">
                            <div id="singkatanError" class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <input type="text" class="form-control" id="jenjang" name="jenjang" required
                                placeholder="Jenjang">
                            <div id="jenjangError" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="mdi mdi-content-save"></span> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- editModal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Edit Data Prodi</h5>
                    <button type="button" class="btn-close-edit btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="kodeProdi" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" id="edit-kode" name="kode_prodi" required
                                placeholder="Kode prodi">
                            <div id="edit-kodeError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="namaProdi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama_prodi" required
                                placeholder="Nama prodi">
                            <div id="edit-namaError" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="singkatan" class="form-label">Singkatan</label>
                            <input type="text" class="form-control" id="edit-singkatan" name="singkatan" required
                                placeholder="Singkatan">
                            <div id="edit-singkatanError" class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <input type="text" class="form-control" id="edit-jenjang" name="jenjang" required
                                placeholder="Jenjang">
                            <div id="edit-jenjangError" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="mdi mdi-content-save"></span> Simpan</button>
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
        });

        //Tambah
        $('#tambahForm').submit(function(e) {
            e.preventDefault();

            let kode = $('#kodeProdi').val();
            let nama = $('#namaProdi').val();
            let singkatan = $('#singkatan').val();
            let jenjang = $('#jenjang').val();

            $('#kodeError').text('').removeClass('is-invalid');
            $('#namaError').text('').removeClass('is-invalid');
            $('#singkatanError').text('').removeClass('is-invalid');
            $('#jenjangError').text('').removeClass('is-invalid');

            $.ajax({
                url: '{{ route('prodi.store') }}',
                method: 'POST',
                data: {
                    kode_prodi: kode,
                    nama_prodi: nama,
                    singkatan: singkatan,
                    jenjang: jenjang
                },
                success: function(response) {
                    $('tbody').append(`
                <tr>
                    <td>${$('tbody tr').length + 1}</td>
                    <td>${response.prodi.kode_prodi}</td>
                    <td>${response.prodi.nama_prodi}</td>
                    <td>${response.prodi.singkatan}</td>
                    <td>${response.prodi.jenjang}</td>
                    <td>
                       <button class="btn btn-warning btn-sm edit-btn"
                    data-id="${response.prodi.id}" 
                    data-kode="${response.prodi.kode_prodi}"
                    data-nama="${response.prodi.nama_prodi}"
                    data-singkatan="${response.prodi.singkatan}"
                    data-jenjang="${response.prodi.jenjang}" 
                    data-toggle="modal" 
                    data-target="#editModal">Edit</button>
                <form id="delete-form-${response.prodi.id}" action="{{ route('prodi.destroy', '') }}/${response.prodi.id}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('${response.prodi.id}')">
                        <span class="mdi mdi-delete"></span> Hapus
                    </button>
                        </form>
                    </td>
                </tr>
            `);
                    // Tutup modal dan reset form
                    $('#tambahModal').modal('hide');
                    $('#tambahForm')[0].reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: response.success,
                        confirmButtonText: 'Oke'
                    });
                },
                error: function(response) {
                    if (response.status === 422) {
                        const errors = response.responseJSON.errors;
                        if (errors.kode_prodi) {
                            $("#kodeProdi").addClass('is-invalid');
                            $('#kodeError').text(errors.kode_prodi[0]);
                        }
                        if (errors.nama_prodi) {
                            $("#namaProdi").addClass('is-invalid');
                            $('#namaError').text(errors.nama_prodi[0]);
                        }
                        if (errors.singkatan) {
                            $("#singkatan").addClass('is-invalid');
                            $('#singkatanError').text(errors.singkatan[0]);
                        }
                        if (errors.jenjang) {
                            $("#jenjang").addClass('is-invalid');
                            $('#jenjangError').text(errors.jenjang[0]);
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


        //data edit
        $('.edit-btn').click(function() {
            let id = $(this).data('id');
            let kode = $(this).data('kode');
            let nama = $(this).data('nama');
            let singkatan = $(this).data('singkatan');
            let jenjang = $(this).data('jenjang');

            $('#edit-id').val(id);
            $('#edit-kode').val(kode);
            $('#edit-nama').val(nama);
            $('#edit-singkatan').val(singkatan);
            $('#edit-jenjang').val(jenjang);

            $('#editNamaError').text('');
            $('#editKodeError').text('');
            $('#editSingkatanError').text('');
            $('#editJenjangError').text('');
            $('#editModal').modal('show');
        });

        
        //edit form
        $('#editForm').submit(function(e) {
            e.preventDefault();
            let id = $('#edit-id').val();
            let kode = $('#edit-kode').val();
            let nama = $('#edit-nama').val();
            let singkatan = $('#edit-singkatan').val();
            let jenjang = $('#edit-jenjang').val();


            $.ajax({
                url: '{{ route('prodi.update', ':id') }}'.replace(':id', id),
                method: 'PUT',
                data: {
                    kode_prodi: kode,
                    nama_prodi: nama,
                    singkatan: singkatan,
                    jenjang: jenjang
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                    $('#editForm')[0].reset();

                    $('#name-' + id).text(nama);
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: response.success,
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.href = '/presensi/data-master/prodi';
                    });
                },
                error: function(response) {
                    if (response.status === 422) {
                        const errors = response.responseJSON.errors;
                        if (errors.kode_prodi) {
                            $("#edit-kode").addClass('is-invalid');
                            $('#edit-kodeError').text(errors.kode_prodi[0]);
                        }
                        if (errors.nama_prodi) {
                            $("#edit-nama").addClass('is-invalid');
                            $('#edit-namaError').text(errors.nama_prodi[0]);
                        }
                        if (errors.singkatan) {
                            $("#edit-singkatan").addClass('is-invalid');
                            $('#edit-singkatanError').text(errors.singkatan[0]);
                        }
                        if (errors.jenjang) {
                            $("#edit-jenjang").addClass('is-invalid');
                            $('#edit-jenjangError').text(errors.jenjang[0]);
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

        //reset data
        $('.btn-close-tambah').click(function() {
            $('#tambahForm')[0].reset();
            $('#kodeError').text('');
            $('#namaError').text('');
            $('#singkatanError').text('');
            $('#jenjangError').text('');
            $('#kodeProdi').removeClass('is-invalid');
            $('#namaProdi').removeClass('is-invalid');
            $('#singkatan').removeClass('is-invalid');
            $('#jenjang').removeClass('is-invalid');
        });
        $('.btn-close-edit').click(function() {
            $('#edit-kode').removeClass('is-invalid');
            $('#edit-nama').removeClass('is-invalid');
            $('#edit-singkatan').removeClass('is-invalid');
            $('#edit-jenjang').removeClass('is-invalid');

            $('#edit-kodeError').text('');
            $('#edit-namaError').text('');
            $('#edit-singkatanError').text('');
            $('#edit-jenjangError').text('');
            $('#editForm')[0].reset();
        });

        // Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    const url = form.action;

                    axios.delete(url, {
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => {
                            Swal.fire('Terhapus!', response.data.success, 'success').then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'Gagal menghapus prodi.', 'error');
                        });
                }
            });
        }
    </script>
@endsection
