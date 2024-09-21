<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="/">
                <img src={{ asset('/images/logomini.png') }} alt="polsa logo" />
                <span class="fw-bolder">POLSA</span>
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
                <img src={{ asset('/images/logomini.png') }} alt="polsa logo" style="padding-right: 2px;padding-left:2px"/>
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                @if (Request::is('dashboard'))
                <h1 class="welcome-text">Selamat Pagi,<span class="text-black fw-bold">Adminstator</span></h1>
                <h3 class="welcome-sub-text">Absensi Mahasiswa</h3>
                @elseif(Request::is('presensi/data-master/daftar-kelas'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Daftar Kelas</span></h1>
                @elseif(Request::is('presensi/data-master/prodi'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Daftar Prodi</span></h1>
                @elseif(Request::is('presensi/data-master/ruangan'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Daftar Ruangan</span></h1>
                @elseif(Request::is('data-umum/mata-kuliah'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Mata Kuliah</span></h1>
                @elseif(Request::is('presensi/data-master/semester'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Daftar Semester</span></h1>
                @elseif(Request::is('presensi/data-master/tahun-akademik'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Tahun Akademik</span></h1>
                @elseif(Request::is('data-umum/kaprodi'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Kaprodi</span></h1>
                @elseif(Request::is('data-umum/wakil-direktur'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Wakil Direktur</span></h1>
                @elseif(Request::is('jadwal-mengajar'))
                <h1 class="welcome-text"><span class="text-black fw-bold">Jadwal Mengajar</span></h1>
                @elseif(Request::is("data-direktur"))
                <h1 class="welcome-text"><span class="text-black fw-bold">Data Direktur</span></h1>
                @elseif(Request::is("data-dosen"))
                <h1 class="welcome-text"><span class="text-black fw-bold">Data Dosen</span></h1>
                @elseif(Request::is("presensi"))
                <h1 class="welcome-text"><span class="text-black fw-bold">Presensi</span></h1>
                @elseif(Request::is("presensi"))
                <h1 class="welcome-text"><span class="text-black fw-bold">Presensi</span></h1>
                @elseif(Request::is("daftar-jadwal-mengajar"))
                <h1 class="welcome-text"><span class="text-black fw-bold">Jadwal Mengajar</span></h1>
                @endif
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @if(Request::is("jadwal-mengajar"))
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>
            @endif
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                            alt="Profile image">
                        <p class="mb-1 mt-3 fw-semibold">atmin</p>
                        <p class="fw-light text-muted mb-0">atmin@gmail.com</p>
                    </div>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span
                            class="badge badge-pill badge-danger">1</span></a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                        Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
