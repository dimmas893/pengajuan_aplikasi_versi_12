<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Aplikasi Pengajuan</title>

    @include('layouts.superadmin.css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.superadmin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                @include('layouts.superadmin.navbar')
     
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                @include('layouts.superadmin.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="btn btn-danger" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                         </a>
                        </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.superadmin.script')

    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}

    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    
    {{-- <script>
        $(function() {
            
            ajax();
            function ajax() {
                $.ajax({
                url: '/kerja/pengajuan_aplikasi_versi_7/tes',
                method: 'get',
                success: function(response) {
                console.log()
                $('#ajax').html(response.tes);
                }
            });
            }
            
            
        
          data_admin_barang_approve();
        
                function data_admin_barang_approve() {
                  $.ajax({
                    url: '{{ route('approval_data_admin_barang_approve') }}',
                    method: 'get',
                    success: function(response) {
                      $("#data_admin_barang_approve").html(response);
                      $("table").DataTable({
                          destroy: true,
                          // retrieve: true,
                          // paging: false
                      });
                    }
                  });
                }
        
            data_admin_barang_belum_approve();
        
                function data_admin_barang_belum_approve() {
                  $.ajax({
                    url: '{{ route('approval_data_admin_barang_belum_approve') }}',
                    method: 'get',
                    success: function(response) {
                      $("#data_admin_barang_belum_approve").html(response);
                      $("table").DataTable({ 
                          destroy: true,  
                          // retrieve: true,
                          // paging: false 
                      });
                    }
                  });
                }
        
        
            
            
            window.Echo.channel("message").listen("Notif", (event) => {
                    console.log(event);
                    if (event) {
                        swal({
                        type: "success",
                        icon: "success",
                        title: "ADA PENGAJUAN BARU !!",
                        text: "Harap Segera Di Tinjau",
                        timer: 1500,
                        showConfirmButton: false,
                        showCancelButton: false,
                        buttons: false,
                        });
                        }
                        ajax();
                        // data_admin_barang_approve();
                        
                        // audio();
                        
                        var audio = new Audio('/kerja/pengajuan_aplikasi_versi_7/public/audio.mp3')
                        audio.play()
                        data_admin_barang_belum_approve();
                    });
                });
            </script>
            {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
            {{-- <script src="/kerja/pengajuan_aplikasi_versi_7/public/js/app.js"></script> --}}
        
</body>

</html>