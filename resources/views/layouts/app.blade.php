<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAKAD - Sistem Informasi Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e40af 0%, #2563eb 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.92);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.18);
            color: white;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.12);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .card-stats {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
        }
        .btn-action {
            margin: 0 2px;
        }
        footer {
            background: white;
            padding: 15px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .main-content {
            margin-bottom: 60px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 px-0">
                    <div class="sidebar">
                        <div class="text-center py-4">
                            <h4 class="text-white">SIAKAD</h4>
                            <small class="text-white-50">Sistem Informasi Akademik</small>
                            <hr class="bg-light">
                            <div class="text-white">
                                <i class="bi bi-person-circle fs-1"></i>
                                <p class="mt-2">{{ Auth::user()->name }}</p>
                                <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>
                        </div>
                        <nav class="nav flex-column">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                            
                            @if(Auth::user()->role === 'admin')
                                <a class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}">
                                    <i class="bi bi-people"></i> Data Dosen
                                </a>
                                <a class="nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}" href="{{ route('admin.mahasiswa.index') }}">
                                    <i class="bi bi-mortarboard"></i> Data Mahasiswa
                                </a>
                                <a class="nav-link {{ request()->routeIs('admin.matakuliah.*') ? 'active' : '' }}" href="{{ route('admin.matakuliah.index') }}">
                                    <i class="bi bi-book"></i> Mata Kuliah
                                </a>
                                <a class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}" href="{{ route('admin.jadwal.index') }}">
                                    <i class="bi bi-calendar-week"></i> Jadwal
                                </a>
                                <a class="nav-link {{ request()->routeIs('admin.krs.*') ? 'active' : '' }}" href="{{ route('admin.krs.index') }}">
                                    <i class="bi bi-card-list"></i> Manajemen KRS
                                </a>
                            @endif
                            
                            @if(Auth::user()->role === 'mahasiswa')
                                <a class="nav-link {{ request()->routeIs('mahasiswa.krs.index') ? 'active' : '' }}" href="{{ route('mahasiswa.krs.index') }}">
                                    <i class="bi bi-card-list"></i> KRS Saya
                                </a>
                                <a class="nav-link {{ request()->routeIs('mahasiswa.krs.create') ? 'active' : '' }}" href="{{ route('mahasiswa.krs.create') }}">
                                    <i class="bi bi-plus-circle"></i> Ambil Mata Kuliah
                                </a>
                                <a class="nav-link {{ request()->routeIs('mahasiswa.jadwal.index') ? 'active' : '' }}" href="{{ route('mahasiswa.jadwal.index') }}">
                                    <i class="bi bi-calendar-week"></i> Jadwal Saya
                                </a>
                            @endif
                            
                            <hr class="bg-light">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </form>
                        </nav>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="col-md-9 col-lg-10 p-4 main-content" style="background: #f8f9fa; min-height: 100vh;">
            @else
                <div class="col-12 p-4 main-content" style="background: #f8f9fa; min-height: 100vh;">
            @endauth
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <footer class="text-center">
        <div class="container">
            <span>&copy; {{ date('Y') }} Sistem Informasi Akademik - Tugas Besar Web II</span>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>