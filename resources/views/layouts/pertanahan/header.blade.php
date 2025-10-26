<header class="navbar navbar-expand-lg shadow-sm sticky-top"
    style="background: linear-gradient(90deg, #4b5320, #6b8e23); min-height: 70px;">
    <div class="container-fluid px-4 d-flex align-items-center">

        {{-- Logo / Title --}}
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ route('dashboard') }}">
            <i class="fas fa-leaf me-2 fs-4"></i>
            <span class="fs-5 align-middle">Pertanahan</span>
        </a>

        {{-- Toggle (mobile) --}}
        <button class="navbar-toggler text-white border-0 ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

                {{-- Beranda --}}
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>

                {{-- Jenis Penggunaan --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" id="menuLayanan"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-layer-group me-1"></i> Jenis Penggunaan
                    </a>
                    <ul class="dropdown-menu shadow-sm border-0 rounded-3" aria-labelledby="menuLayanan">
                        <li><a class="dropdown-item" href="{{ route('penggunaan.index') }}"><i class="fas fa-folder-open me-2 text-success"></i>Data Penggunaan</a></li>
                    </ul>
                </li>

                {{-- Warga --}}
<li class="nav-item dropdown position-relative">
  <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" id="Warga"
      role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-user me-1"></i> Warga
  </a>
  <ul class="dropdown-menu shadow-sm border-0 rounded-3 custom-dropdown" aria-labelledby="Warga">
      <li>
          <a class="dropdown-item" href="{{ route('warga.create') }}">
              <i class="fas fa-user me-2 text-success"></i>Data Warga
          </a>
      </li>
  </ul>
</li>


                {{-- User --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" id="menuUser"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-cog me-1"></i> User
                    </a>
                    <ul class="dropdown-menu shadow-sm border-0 rounded-3" aria-labelledby="menuUser">
                        <li><a class="dropdown-item" href="{{ route('user.index') }}"><i class="fas fa-users me-2 text-success"></i>Data User</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.create') }}"><i class="fas fa-user-plus me-2 text-success"></i>Tambah User</a></li>
                    </ul>
                </li>

                {{-- Profile --}}
                @auth
                <li class="nav-item dropdown ms-lg-3 d-flex align-items-center">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center fw-semibold px-3"
                        href="#" id="menuProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b8e23&color=fff&size=32"
                            alt="Profile" class="rounded-circle me-2 border border-light" width="32" height="32">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3" aria-labelledby="menuProfile">
                        <li class="dropdown-header text-center">
                            <strong>{{ Auth::user()->name }}</strong><br>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</header>

