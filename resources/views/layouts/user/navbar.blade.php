<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        @php
            $level_1 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1', null)->limit(5)->get();
            $notifcountlevel_1 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1', null)->get();

            $level_2 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1', '!=' , null)->where('level_2', null)->limit(5)->get();
            $notifcountlevel_2 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1',  '!=', null)->where('level_2', null)->get();

            

            $level_3 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1', '!=' , null)->where('level_2', '!=', null)->where('level_3', null)->limit(5)->get();
            $notifcountlevel_3 = \App\Models\Pengajuan::with('user_pengajuan')->where('level_1', '!=' , null)->where('level_2','!=',  null)->where('level_3', null)->get();


            $user = \App\Models\User::where('id', Auth::user()->id)->where('role', null)->first();  
            $admin = \App\Models\User::where('id', Auth::user()->id)->where('role', 'level_1')->first();
            $superadmin = \App\Models\User::where('id', Auth::user()->id)->where('role', 'level_2')->first();  
            $supersuperadmin = \App\Models\User::where('id', Auth::user()->id)->where('role', 'level_3')->first();  
        @endphp
        
                <!-- Nav Item - Alerts -->
                @if($admin)
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter" id="ajax"></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifikasi
                            </h6>
                            @foreach ($level_1 as $item)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div> 
                                    <div>
                                        <div class="small text-gray-500">{{ $item->tanggal }}</div>
                                        <span class="font-weight-bold">{{ $item->user_pengajuan->name }} - Rp {{ number_format($item->total_biaya,2,',','.') }}</span>
                                    </div>
                                </a>
                                @endforeach
                                <div class="text-center mt-2 mb-2">
                                    @if($notifcountlevel_1->count() > 5)
                                    <a href="{{ route('approval_admin') }}" class="badge badge-success">Tampilkan Semua</a>
                                    @endif
                                </div>
                            </div>
                    </li>
                @endif

                  @if($superadmin)
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">{{ $notifcountlevel_2->count() }}</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifikasi
                            </h6>
                            @foreach ($level_2 as $item)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div> 
                                    <div>
                                        <div class="small text-gray-500">{{ $item->tanggal }}</div>
                                        <span class="font-weight-bold">{{ $item->user_pengajuan->name }} - Rp {{ number_format($item->total_biaya,2,',','.') }}</span>
                                    </div>
                                </a>
                                @endforeach
                                <div class="text-center mt-2 mb-2">
                                    @if($notifcountlevel_2->count() > 1)
                                    <a href="{{ route('super_admin_approval') }}" class="badge badge-success">Tampilkan Semua</a>
                                    @endif
                                </div>
                            </div>
                    </li>
                @endif

                   @if($supersuperadmin)
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">{{ $notifcountlevel_3->count() }}</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifikasi
                            </h6>
                            @foreach ($level_3 as $item)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div> 
                                    <div>
                                        <div class="small text-gray-500">{{ $item->tanggal }}</div>
                                        <span class="font-weight-bold">{{ $item->user_pengajuan->name }} - Rp {{ number_format($item->total_biaya,2,',','.') }}</span>
                                    </div>
                                </a>
                                @endforeach
                                <div class="text-center mt-2 mb-2">
                                    @if($notifcountlevel_3->count() > 5)
                                    <a href="{{ route('super_super_admin_approval') }}" class="badge badge-success">Tampilkan Semua</a>
                                    @endif
                                </div>
                            </div>
                    </li>
                @endif
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        <img class="img-profile rounded-circle"
                            src="{{ asset('public/img/undraw_profile.svg') }}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>


            </ul>

</nav>