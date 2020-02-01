@extends('layouts.element.main')

@section('title', 'Histori')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp

@include('layouts.element.navbar')

<!-- Header -->
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
          <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-1">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="fa fa-home text-info"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Histori
                            </li>
                        </ol>
                    </nav>
                </div>
               
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-role">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Yang Diubah</th>
                    <th scope="col">Aktifitas</th>
                    {{-- <th scope="col">Detail Aktifitas</th> --}}
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($logs as $l)
                @php
                    $date = date_create($l->tanggal);
                    $waktu = date_format($date, 'H:m:i');
                    $tanggal = date_format($date, 'l F, Y');

                    if ($l->product_change == 1) {
                        $change = "Produk";
                    }elseif($l->supplier_change == 1){
                        $change = "Supplier";
                    }elseif($l->order_change == 1){
                        $change = "Order";
                    }elseif($l->debt_change == 1){
                        $change = "Hutang";
                    }elseif($l->convert_change == 1){
                        $change = "Konversi";
                    }elseif($l->category_change == 1){
                        $change = "Kategori";
                    }elseif($l->unit_change == 1){
                        $change = "Satuan";
                    }elseif($l->infomation_change == 1){
                        $change = "Keterangan Satuan";
                    }elseif($l->role_change == 1){
                        $change = "Role";
                    }elseif($l->account_change == 1){
                        $change = "Akun";
                    }
                    

                @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $tanggal }}</td>
                    <td>{{ $waktu }}</td>
                    <td>{{ $l->User->name }}</td>
                    <td>
                        {{ $change }}
                    </td>
                    <td>{{ $l->activity }}</td>
                    {{-- <td>{{ $l->detail_activity }}</td> --}}
                    <td>
                        <div class="dropdown-item">
                            <a href="javascript:;" data-change="{{ $change }}" data-detail="{{ $l->detail_activity }}" data-activity="{{ $l->activity }}"  data-day="{{ $tanggal }}" data-time="{{ $waktu }}" data-name="{{ $l->User->name }}"  class="btn-detail badge badge-pill badge-info">
                                Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer py-4">
                {{-- <button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal">Default</button> --}}
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                  <div class="modal-content">
                      
                        <div class="modal-header">
                            <h2 class="modal-title text-info" id="modal-title-default">Detail Histori</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body p-5">
                            <div class="row">
                                <div class="col-md-8">
                                    <p id="text-day" class="font-weight-bold text-primary text-lg"></p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <p id="text-time" class="font-weight-bold text-primary text-lg"></p>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <p id="text-name" class="text-dark font-weight-bold"></p>
                                    <p id="text-change" class="text-dark font-weight-bold"></p>
                                    <p id="text-activity" class="text-dark font-weight-bold"></p>
                                    <p id="text-detail" class="text-dark font-weight-bold"></p>
                                </div>
                            </div>     
                            
                        </div>
    
                  </div>
              </div>
            </div>
            {{ $logs->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {

        $('#table-role').DataTable({
            paging: false,
            searching: true,
        });

        $('.btn-detail').on('click', function(){
            
            $('#modal-default').modal('show')

            $('#text-day').html('');
            $('#text-time').html('');
            $('#text-name').html('Nama Pengubah: ');
            $('#text-change').html('Apa Yang Diubah: ');
            $('#text-activity').html('Jenis Yang Diubah: ');
            $('#text-detail').html('Detail: ');

            $('#text-day').append($(this).data('day'))
            $('#text-time').append($(this).data('time'))
            $('#text-name').append($(this).data('name'))
            $('#text-change').append($(this).data('change'))
            $('#text-activity').append($(this).data('activity'))
            $('#text-detail').append($(this).data('detail'))
        })

        $('.btn-danger').on('click', function() {

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1aae6f',
            cancelButtonColor: '#f80031',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.value) {
                    var data = $(this).data('id')
                    console.log(data)
                    window.location = data;
                }else{
                    Swal.fire(
                    'Cancelled!',
                    'Your file has been cancel.',
                    'error'
                    )
                }
            })
        });

    } );

</script>
