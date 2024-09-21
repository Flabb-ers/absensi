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
                                            <th> Tahun Akademik </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tahuns as $tahun)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tahun->tahun_akademik }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $tahun->id }}"
                                                        data-tahun="{{ $tahun->tahun_akademik }}" data-toggle="modal"
                                                        data-target="#editModal"><span class="mdi mdi-pencil"></span>
                                                        Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $tahun->id }}">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Takun akademik belum ditambahkan</td>
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
    <div class="modal fade " id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Tahun Akademik</h5>
                    <button type="button" class="btn-close tambahModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="tahunAkademik" class="form-label">Tahun Akademik</label>
                            <input type="text" class="form-control" id="tahunAkademik" name="nama"
                                placeholder="YYYY/YYYY" required>
                            <div id="tahunAkademikError" class="invalid-feedback"></div>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Tahun Akademik</h5>
                    <button type="button" class="btn-close editModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editTahunId" name="id">
                        <div class="mb-3">
                            <label for="editTahunAkademik" class="form-label">Tahun Akademik</label>
                            <input type="text" class="form-control" id="editTahunAkademik" name="tahun_akademik"
                                required>
                            <div id="editTahunAkademikError" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">
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

            $('#tambahForm').submit(function(e) {
                e.preventDefault();

                let tahun_akademik = $('#tahunAkademik').val();
                $('#tahunAkademikError').text('');

                $.ajax({
                    url: '{{ route('tahun-akademik.store') }}',
                    method: 'POST',
                    data: {
                        tahun_akademik: tahun_akademik,
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
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            $("#tahunAkademik").addClass('is-invalid');
                            $('#tahunAkademikError').text(response.responseJSON.errors
                                .tahun_akademik[0]);
                        }
                    }
                });
            });

            $('.edit-btn').on('click', function() {
                let id = $(this).data('id');
                let tahun = $(this).data('tahun');

                $('#editTahunId').val(id);
                $('#editTahunAkademik').val(tahun);
                $('#editTahunAkademikError').text('');
                $('#editTahunAkademik').removeClass('is-invalid');
                $('#editModal').modal('show');
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                let id = $('#editTahunId').val();
                let tahun_akademik = $('#editTahunAkademik').val();

                $.ajax({
                    url: '{{ route('tahun-akademik.update', ':id') }}'.replace(':id', id),
                    method: 'PUT',
                    data: {
                        tahun_akademik: tahun_akademik
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
                            $('#editTahunAkademik').addClass('is-invalid');
                            $('#editTahunAkademikError').text(response.responseJSON
                                .errors.tahun_akademik[0]);
                        }
                    }
                });
            });
            $('.delete-btn').click(function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Tahun akademik ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('tahun-akademik.destroy', ':id') }}'.replace(
                                ':id', id),
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    response.success,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire(
                                    'Oops...',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            $('.editModal').on('hidden.bs.modal', function() {
                $('#editForm')[0].reset();
                $('#editTahunAkademik').removeClass('is-invalid');
                $('#editTahunAkademikError').text('');
            });

            $('#tambahModal').on('hidden.bs.modal', function() {
                $('#tambahForm')[0].reset();
                $('#tahunAkademik').removeClass('is-invalid');
                $('#tahunAkademikError').text('');
            });
        });
    </script>
@endsection
