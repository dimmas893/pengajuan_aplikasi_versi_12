@extends('layouts.supersuperadmin.template_super_super_admin')
@section('content')


@php
$level_2 = \App\Models\User::where('id', Auth::user()->id)->where('role', 'level_3')->first();
@endphp
    @if ($level_2)
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#approve" role="tab" data-toggle="tab">Approve</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#belumapprove" role="tab" data-toggle="tab">Belum Approve</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active show" id="approve">
         <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <div id="data_level_3_barang_approve"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <div role="tabpanel" class="tab-pane fade in" id="belumapprove">
         <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <div id="data_level_3_barang_belum_approve"></div>
                        </div>
                    </div>
                </div>
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

      data_level_3_barang_approve();

      function data_level_3_barang_approve() {
        $.ajax({
          url: '{{ route('approval_data_level_3_barang_approve') }}',
          method: 'get',
          success: function(response) {
            $("#data_level_3_barang_approve").html(response);
            $("table").DataTable({
                destroy: true,
                // retrieve: true,
                // paging: false
            });
          }
        });
      }

      data_level_3_barang_belum_approve();

      function data_level_3_barang_belum_approve() {
        $.ajax({
          url: '{{ route('approval_data_level_3_barang_belum_approve') }}',
          method: 'get',
          success: function(response) {
            $("#data_level_3_barang_belum_approve").html(response);
            $("table").DataTable({ 
                destroy: true,  
                // retrieve: true,
                // paging: false 
            });
          }
        });
      }

      
    });
    
        </script>
    @endsection

    @endif
@endsection