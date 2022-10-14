  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  {{-- {<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script> --}}
  <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Bootstrap core JavaScript-->
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Core plugin JavaScript-->
  @yield('script')
  <script src="{{ asset('public/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  
  <!-- Core plugin JavaScript-->
  {{-- <script src=""></script> --}}
  
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('public/js/sb-admin-2.min.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    //sweetalert for success or error message
    @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
  </script>
    
