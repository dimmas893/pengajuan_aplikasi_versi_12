@extends('layouts.user.template_user')
@section('content')
@php
$admin = \App\Models\User::where('id', Auth::user()->id)->where('role', 'admin')->first();
$user = \App\Models\User::where('id', Auth::user()->id)->where('role', null)->first();  
@endphp

@if($user)
    <div class="card">
        <div class="card-header">
            </div>
                <div class="card-body">
                  @if($pengajuan->level_1 == null)
                      
                    <div class="row w-auto">
                        <div class="col-12">
                           <form action="{{ route('keranjang_store_approve') }}" method="post">
                                @csrf
                                <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                                <div>
                                   <select class="form-control js-example-basic-single" style="width:100%;" name="barang_id" id="barang_id">
                                       <option disabled selected>---Pilihan Barang----</option>
                                        @foreach($barang as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_barang }}, Spesifikasi : {{ $p->spesifikasi }}, Harga Barang : Rp {{ number_format($p->harga_barang,2,',','.') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <input type="number" style="width:100%;" class="form-control mt-5" name="jumlah_barang" required placeholder="jumlah"/>
                                </div>
                                <div>
                                <input type="submit" class="btn btn-primary mt-5" id="barang_btn" value="Add">
                            </div>

                            </form>
                        </div>
                    </div>
                  @endif
                </div>
        </div>
      
    <div class="row">
        <div class="col-9">
            <div class="card">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <div class="text-right">
                                    </div>

                                    <div class="table-responsive">
                                        @if($pengajuan->level_1 == null)
                                            <div class="card-body" id="all">
                                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                                            </div>
                                        @endif
                                          @if($pengajuan->level_1 != null)
                                            @if ($pengajuan->level_1 != null)
                                                @if ($pengajuan->level_2 == null)
                                                    <h2 style="color:chartreuse">Approve Level 1</h2> <hr>
                                                @endif
                                            @endif
                                            @if ($pengajuan->level_2 != null)
                                                @if ($pengajuan->level_3 == null)
                                                    <h2 style="color:chartreuse">Approve Level 2</h2> <hr>
                                                @endif
                                            @endif

                                            @if ($pengajuan->level_3 != null)
                                                <h2 style="color:chartreuse">Selamat Pengajuan Anda Di Approve</h2> <hr>
                                            @endif
                                            <div class="card-body" id="all_kondisi">
                                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
        </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">Action</div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                {{-- <p>total biaya : Rp {{ number_format($->barang->harga_barang,2,',','.') }}</p> --}}
                                 @if($pengajuan->level_1 != null)
                                    <p>Total Biaya</p>
                                    <p>
                                      <h6 id="data"> </h6>
                                    </p>
                                 @endif
                        @if($pengajuan->level_1 == null)
                            @if($pengajuan_detail->count() > 0)
                            <p>Total Biaya</p>
                            <p>
                              <h6 id="data"> </h6>
                            </p>
                      
                            {{-- <p>Rp {{ number_format($pengajuan->total_biaya,2,',','.') }}</p> --}}
                                {{-- <form action="/approval/approve_admin" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pengajuan->id }}">
                                    <input type="submit" class="btn btn-success mb-5 text-center" value="Approve">
                                </form> --}}
                                    
                            @endif
                        @endif
                            </div>
                        <div class="col-6">
                            <a href="{{ route('approval') }}" class="btn btn-primary">Back</a>
                           
                        </div>
                        </div>
                    </div>
                </div>
            </div>

                  <div class="modal fade" id="pengajuan_detail" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengajuan</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> --}}
            </div>
            <form action="#" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="pengajuan_id" id="pengajuan_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="jumlah_barang">jumlah_barang</label>
                            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" placeholder="Jumlah barang" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="button" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    </div>
@endif
@section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('script')

  {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2(); 
            });
        </script>

  {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
    
<script>

    
    $(function() {

      // $("#add_item_form").submit(function(e) {
      //   e.preventDefault();
      //   const fd = new FormData(this);
      //   $("#barang_btn").text('Adding...');
      //   $.ajax({
      //     url: '{{ route('keranjang_store_approve') }}',
      //     method: 'post',
      //     data: fd,
      //     cache: false,
      //     contentType: false,
      //     processData: false,
      //     dataType: 'json',
      //     success: function(response) {
      //       if (response.status == 200) {
      //          swal({
      //             type: "success",
      //             icon: "success",
      //             title: "BERHASIL!",
      //             text: "Berhasil Menambah Data",
      //             timer: 1500,
      //             showConfirmButton: false,
      //             showCancelButton: false,
      //             buttons: false,
      //         });
      //         all_kondisi();
      //         datatabless();
      //       }
      //       $("#barang_btn").text('Save');
      //       $("#add_item_form")[0].reset();
      //       $("#modal_add").modal('hide');
      //     }
      //   });
      // });

 $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('approval_edit_ajax') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#jumlah_barang").val(response.jumlah_barang);
            $("#pengajuan_id").val(response.pengajuan_id);
            $("#id").val(response.id);
          }
        });
      });
      
    $("#form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#button").text('Updating...');
        $.ajax({
          url: '{{ route('approval_update_ajax') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
                swal({
                  type: "success",
                  icon: "success",
                  title: "BERHASIL!",
                  text: "Berhasil Mengubah Data",
                  timer: 1500,
                  showConfirmButton: false,
                  showCancelButton: false,
                  buttons: false,
              });
              total();
              datatabless();
              
            }
            $("#button").text('Update');
            $("#form")[0].reset();
            $("#pengajuan_detail").modal('hide');
          }
        });
      });

      datatabless();

      function datatabless() {
        $.ajax({
          url: '{{ route('all_2', $pengajuan->id) }}',
          method: 'get',
          success: function(response) {
            $("#all").html(response);
            $("table").DataTable({
                 "bFilter": false, 
                 "bInfo": false,
                 "bPaginate": false,
                 "paging": false,
                 "destroy": true,
            });
          }
        });
      }

        all_kondisi();

    function all_kondisi() {
        $.ajax({
          url: '{{ route('all_kondisi', $pengajuan->id) }}',
          method: 'get',
          success: function(response) {
            $("#all_kondisi").html(response);
            $("table").DataTable({
                 "bFilter": false, 
                 "bInfo": false,
                 "bPaginate": false,
                 "paging": false,
                 "destroy": true,
            });
          }
        });
      }

       total();

        function total() {
        $.ajax({
          url: '{{ route('total', $pengajuan->id) }}',
          method: 'get',
          success: function(response) {

            function numberWithCommas(x) {
              return x.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            // console.log()
            $('#data').html('Rp ' + numberWithCommas(response.data));
            // $("#total_biaya").html(response);
            //  $('#tes').html(response.tes);
            //  $('#data').html(response.data);
            //  $('.dimmas').html(response);
          }
        });
      }

    // $( document ).ready(function() {
    // $.ajax({
          // url: '{{ route('total', $pengajuan->id) }}',
          // method: 'get',
          // success: function(response) {
            // $("#total_biaya").html(response);
            //  $('#tes').html(response.tes);
            //  $('.dimmas').html(response);
            // $('#rp').html('rp');
          // }
        // });

});

//         $.get( "{{ route('total', $pengajuan->id) }}", function( data ) {
//         $("#result").html(data);
//          console.log(data);
//         alert( "Load was performed.");
//         });

//         $( document ).ready(function(dimmas) {
//     console.log( "ready!" );
    
//         $(".dimmas").html(dimmas);
// });

</script>

@endsection
@endsection