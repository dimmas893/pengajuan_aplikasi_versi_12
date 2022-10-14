@extends('layouts.superadmin.template_super_admin')
@section('content')

<div>
  <div class="col-12">
    <div class="card">
      <div class="card mt-2">
        <div class="card-body">
                                  <div class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                      <i class="fa-solid fa-plus"></i>
                                    </button>
                                  </div>
                                    <!-- Button trigger modal -->
                                    <div class="text-right">
                                    </div>

                                    <div class="table-responsive">
                                            <div class="card-body" id="barang_json">
                                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
        </div>

    <div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                <div class="modal-body p-4 bg-light">
                   <div class="modal-body">
                        <div class="mt-2">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukan Nama Barang">
                        </div>
                        <div class="mt-2">
                            <label>Spesifikas Barang</label>
                            <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Masukan Spesifikas Barang">
                        </div>
                        <div class="mt-2">
                            <label>Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="masukan Harga barang">
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('barang_store') }}" id="form" method="post">
        @csrf
        <input type="hidden" name="id" id="id">
      <div class="modal-body">
            <div class="mt-2">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang" required>
            </div>
            <div class="mt-2">
                <label>Spesifikas Barang</label>
                <input type="text" class="form-control" name="spesifikasi" placeholder="Masukan Spesifikas Barang" required>
            </div>
            <div class="mt-2">
                <label>Harga Barang</label>
                <input type="number" class="form-control" name="harga_barang" placeholder="masukan Harga barang" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>
  </div>
</div>

    </div>

    @section('script')
    
  {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
  {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        <script>
             $(function() {


 $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('barang_edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#nama_barang").val(response.nama_barang);
            $("#spesifikasi").val(response.spesifikasi);
            $("#harga_barang").val(response.harga_barang);
            $("#id").val(response.id);
          }
        });
      });
      
    $("#form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#button").text('Updating...');
        $.ajax({
          url: '{{ route('barang_update') }}',
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
              datatabless();
              
            }
            $("#button").text('Update');
            $("#form")[0].reset();
            $("#barang").modal('hide');
          }
        });
      });

      datatabless();

      function datatabless() {
        $.ajax({
          url: '{{ route('barang_json') }}',
          method: 'get',
          success: function(response) {
            $("#barang_json").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }

      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('barang_delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                swal({
                  type: "success",
                  icon: "success",
                  title: "BERHASIL!",
                  text: "Berhasil Menghapus Data",
                  timer: 1500,
                  showConfirmButton: false,
                  showCancelButton: false,
                  buttons: false,
              });
                datatabless();
              }
            });
          }
        })
      });

      
    });
        </script>
    @endsection


@endsection