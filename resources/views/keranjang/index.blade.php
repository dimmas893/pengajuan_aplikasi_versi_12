@extends('layouts.admin.template_admin')
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
                    <div class="row w-auto">
                        <div class="col-12">
                           <form action="{{ route('keranjang_store') }}" method="post">
                                @csrf
                                
                                <div>
                                   <select class="form-control js-example-basic-single" style="width:100%;" name="barang_id" id="barang_id">
                                       <option disabled selected>---Pilihan Barang----</option>
                                        @foreach($barang as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_barang }}, Spesifikasi : {{ $p->spesifikasi }}, Harga Barang : Rp {{ number_format($p->harga_barang,2,',','.') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <input type="number" style="width:100%;" class="form-control mt-5" name="jumlah" required placeholder="jumlah"/>
                                </div>
                                <div>
                                <input type="submit" class="btn btn-primary mt-5" value="Add">
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-9">
                            <div class="card mt-2">
                                <div class="card-body"> 
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <td>No</td>
                                                <td>Nama</td>
                                                <td>Spesifikasi</td>
                                                <td>Jumlah Barang</td>
                                                <td>Harga Satuan</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                <h1>Tabel Pengajuan</h1>
                                                @foreach($keranjang as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->barang->nama_barang }}</td>
                                                        <td>{{ $p->barang->spesifikasi }}</td>
                                                        <td>{{ $p->jumlah}}</td>
                                                        <td>Rp {{ number_format($p->harga_satuan,2,',','.') }}</td>
                                                        <td><a href="{{ route('keranjang_delete', $p->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            </div>
             <div class="col-3">
                            <div class="card mt-2">
                                <div class="card-body"> 
                                    <div class="table-responsive">
                                        <p>Total Biaya</p>
                                        <h4 id="data"></h4>
                                           <form action="{{ route('simpan_pengajuan') }}" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-primary mt-5" value="Ajukan">
                                            </form>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
@endif
@section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
    @section('script')
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2(); 
            });
        </script>

<script>
    $(function() {

        total();

        function total() {
        $.ajax({
          url: '{{ route('keranjang_total') }}',
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
            });
</script>
    @endsection

@endsection