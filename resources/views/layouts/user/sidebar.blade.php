        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Aplikasi Pengajuan</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            @php
                $cek = \App\Models\User::where('id', Auth::User()->id)->where('role', 'level_1')->first(); 
                $user = \App\Models\User::where('id', Auth::User()->id)->where('role', null)->first(); 
                $superadmin = \App\Models\User::where('id', Auth::User()->id)->where('role', 'level_2')->first(); 
                $supersuperadmin = \App\Models\User::where('id', Auth::User()->id)->where('role', 'level_3')->first(); 
            @endphp

            
            @if($supersuperadmin)
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('barang_super_super_admin') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('super_super_admin_approval') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Approve</span></a>
                </li>
            @endif

            @if($superadmin)
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('barang_super_admin') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('super_admin_approval') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Approve</span></a>
                </li>
            @endif

        @if($user)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keranjang') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pengajuan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('approval') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Approval</span></a>
            </li>
        @endif

        @if($cek)

         <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('barang') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Barang</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('approval_admin') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Aprroval</span></a>
            </li>
        @endif

            <!-- Divider -->
            {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>