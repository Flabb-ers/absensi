@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <div>
                                    <ul>
                                        <li>Mata Kulaih : Apliaksi Server</li>
                                        <li>Tanggal : 20/20/2020</li>
                                        <li>Pertemuanke 20</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-secondary mb-3 btn-sm" id="hadirSemua">Hadir
                                    Semua</button>
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <h6>Nama Siswa 1</h6>
                                        <label>Status Kehadiran:</label>
                                        <div class="row">
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="H">
                                                        H
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="I">
                                                        I
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="S">
                                                        S
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="A">
                                                        A
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="C">
                                                        C
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa1_status"
                                                            value="T">
                                                        T
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <h6>Nama Siswa 2</h6>
                                        <label>Status Kehadiran:</label>
                                        <div class="row">
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="H">
                                                        H
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="I">
                                                        I
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="S">
                                                        S
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="A">
                                                        A
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="C">
                                                        C
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col col-md-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="siswa2_status"
                                                            value="T">
                                                        T
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const setAllToH = () => {
                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    if (radio.value === 'H') {
                        radio.checked = true;
                    }
                });
            };

            document.getElementById('hadirSemua').addEventListener('click', setAllToH);
        });
    </script>
@endsection
