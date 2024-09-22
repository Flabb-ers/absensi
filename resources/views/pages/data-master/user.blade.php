@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambahUserModal">
                                <span class="mdi mdi-plus"></span> Tambah User
                            </button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Nama User </th>
                                            <th> Nama Panjang </th>
                                            <th> NIP </th>
                                            <th> Email </th>
                                            <th> Role </th>
                                            <th> Opsi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->nama_user }}</td>
                                                <td>{{ $user->nama_panjang }}</td>
                                                <td>{{ $user->nip }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->nama_role }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td><button class="btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $user->id }}"
                                                        data-nama_user="{{ $user->nama_user }}"
                                                        data-nama_panjang="{{ $user->nama_panjang }}"
                                                        data-email="{{ $user->email }}" data-nip="{{ $user->nip }}"
                                                        data-roles="{{ json_encode($user->roles->pluck('id')->toArray()) }}"
                                                        data-toggle="modal" data-target="#editUserModal">
                                                        <span class="mdi mdi-pencil"></span> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $user->id }}"
                                                        data-nama_user="{{ $user->nama_user }}">
                                                        <span class="mdi mdi-delete"></span> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Dosen belum ditambahkan</td>
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

        <!-- Modal Tambah User -->
        <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tambahUserForm">
                            @csrf
                            <div class="mb-3">
                                <label for="namaUser" class="form-label">Nama User</label>
                                <input type="text" class="form-control" id="namaUser" name="nama_user">
                                <div class="invalid-feedback" id="errorNamaUser"></div>
                            </div>
                            <div class="mb-3">
                                <label for="namaPanjang" class="form-label">Nama Panjang</label>
                                <input type="text" class="form-control" id="namaPanjang" name="nama_panjang">
                                <div class="invalid-feedback" id="errorNamaPanjang"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    autocomplete="username">
                                <div class="invalid-feedback" id="errorEmail"></div>
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP/NUPTK</label>
                                <input type="number" class="form-control" id="nip" name="nip">
                                <div class="invalid-feedback" id="errorNip"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                                <div class="invalid-feedback" id="errorPassword"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label><br>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group me-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label" for="role_1">
                                                <input type="radio" class="form-check-input" value="1" name="roles[]"
                                                    id="role_1">
                                                Dosen
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group me-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label" for="role_2">
                                                <input type="radio" class="form-check-input" value="2" name="roles[]"
                                                    id="role_2">
                                                Akademik
                                            </label>
                                            <div class="invalid-feedback" id="errorPassword"></div>
                                        </div>
                                        <div class="invalid-feedback" id="errorRoles"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><span
                                    class="mdi mdi-content-save"></span>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit User -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editUserId" name="id">
                            <div class="mb-3">
                                <label for="editNamaUser" class="form-label">Nama User</label>
                                <input type="text" class="form-control" id="editNamaUser" name="nama_user" required>
                                <div class="invalid-feedback" id="editErrorNamaUser"></div>
                            </div>
                            <div class="mb-3">
                                <label for="editNamaPanjang" class="form-label">Nama Panjang</label>
                                <input type="text" class="form-control" id="editNamaPanjang" name="nama_panjang"
                                    required>
                                <div class="invalid-feedback" id="editErrorNamaPanjang"></div>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                                <div class="invalid-feedback" id="editErrorEmail"></div>
                            </div>
                            <div class="mb-3">
                                <label for="editNip" class="form-label">NIP/NUPTK</label>
                                <input type="number" class="form-control" id="editNip" name="nip" required>
                                <div class="invalid-feedback" id="editErrorNip"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label><br>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group me-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label" for="editRole_1">
                                                <input type="radio" class="form-check-input" value="1" name="roles[]"
                                                    id="editRole_1">
                                                Dosen
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group me-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label" for="editRole_2">
                                                <input type="radio" class="form-check-input" value="2" name="roles[]"
                                                    id="editRole_2">
                                                Akademik
                                            </label>
                                        </div>
                                        <div class="invalid-feedback" id="editErrorRoles"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><span class="mdi mdi-content-save"></span>
                                Simpan</button>
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

                //TAMBAH
                $('#tambahUserForm').on('submit', function(e) {
                    e.preventDefault();
                    let formData = {
                        nama_user: $('#namaUser').val(),
                        nama_panjang: $('#namaPanjang').val(),
                        email: $('#email').val(),
                        nip: $('#nip').val(),
                        password: $('#password').val(),
                        roles: $("input[name='roles[]']:checked").map(function() {
                            return $(this).val();
                        }).get(),
                        _token: $('input[name="_token"]').val()
                    };

                    $.ajax({
                        url: "{{ route('users.store') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;

                            $('.invalid-feedback').html('');
                            $('.is-invalid').removeClass('is-invalid');

                            if (errors) {
                                if (errors.nama_user) {
                                    $('#namaUser').addClass('is-invalid');
                                    $('#errorNamaUser').html(errors.nama_user[0]);
                                }
                                if (errors.nama_panjang) {
                                    $('#namaPanjang').addClass('is-invalid');
                                    $('#errorNamaPanjang').html(errors.nama_panjang[0]);
                                }
                                if (errors.email) {
                                    $('#email').addClass('is-invalid');
                                    $('#errorEmail').html(errors.email[0]);
                                }
                                if (errors.nip) {
                                    $('#nip').addClass('is-invalid');
                                    $('#errorNip').html(errors.nip[0]);
                                }
                                if (errors.password) {
                                    $('#password').addClass('is-invalid');
                                    $('#errorPassword').html(errors.password[0]);
                                }
                                if (errors.roles) {
                                    $('#errorRoles').html(errors.roles[0]);
                                }
                            } else {
                                // Jika error lainnya
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat mengirim data!',
                                });
                            }
                        }
                    });
                });

                // tombol edit
                $('.edit-btn').click(function() {
                    let id = $(this).data('id');
                    let namaUser = $(this).data('nama_user');
                    let namaPanjang = $(this).data('nama_panjang');
                    let email = $(this).data('email');
                    let nip = $(this).data('nip');
                    let roles = $(this).data('roles');

                    $('#editUserId').val(id);
                    $('#editNamaUser').val(namaUser);
                    $('#editNamaPanjang').val(namaPanjang);
                    $('#editEmail').val(email);
                    $('#editNip').val(nip);

                    $("input[name='roles[]']").prop('checked', false);
                    roles.forEach(function(role) {
                        $('#editRole_' + role).prop('checked', true);
                    });

                    $('.invalid-feedback').text('').removeClass('is-invalid');
                    $('#editUserModal').modal('show');
                });


                // form edit
                $('#editUserForm').submit(function(e) {
                    e.preventDefault();

                    let id = $('#editUserId').val();
                    let nama_user = $('#editNamaUser').val();
                    let nama_panjang = $('#editNamaPanjang').val();
                    let email = $('#editEmail').val();
                    let nip = $('#editNip').val();
                    let roles = $("input[name='roles[]']:checked").map(function() {
                        return $(this).val();
                    }).get();

                    $('.invalid-feedback').text('').removeClass('is-invalid');

                    $.ajax({
                        url: '{{ route('users.update', ':id') }}'.replace(':id', id),
                        method: 'PUT',
                        data: {
                            nama_user: nama_user,
                            nama_panjang: nama_panjang,
                            email: email,
                            nip: nip,
                            roles: roles
                        },
                        success: function(response) {
                            $('#editUserModal').modal('hide');
                            $('#editUserForm')[0].reset();
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

                                if (errors.nama_user) {
                                    $('#editNamaUser').addClass('is-invalid');
                                    $('#editErrorNamaUser').text(errors.nama_user[0]);
                                }
                                if (errors.nama_panjang) {
                                    $('#editNamaPanjang').addClass('is-invalid');
                                    $('#editErrorNamaPanjang').text(errors.nama_panjang[0]);
                                }
                                if (errors.email) {
                                    $('#editEmail').addClass('is-invalid');
                                    $('#editErrorEmail').text(errors.email[0]);
                                }
                                if (errors.nip) {
                                    $('#editNip').addClass('is-invalid');
                                    $('#editErrorNip').text(errors.nip[0]);
                                }
                                if (errors.roles) {
                                    $('#editErrorRoles').text(errors.roles[0]);
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

                $('.delete-btn').click(function() {
                    let id = $(this).data('id');
                    let nama_user = $(this).data('nama_user');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: "Apakah Anda yakin ingin menghapus user " + nama_user + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('users.destroy', ':id') }}'.replace(':id', id),
                                method: 'DELETE',
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses!',
                                        text: response.success,
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(response) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan saat menghapus user!',
                                    });
                                }
                            });
                        }
                    });
                });

            });
        </script>
    @endsection
