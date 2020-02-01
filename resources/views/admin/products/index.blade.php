@extends('layouts.element.main')

@section('title', 'Produk')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }

        nav{
            float: right;
        }

        .nav-none-float{
            float: none!important;
        }

    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp

@include('layouts.element.navbar')

<!-- Header -->
<div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
          <!-- Table -->
          @if (session('alert'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('alert') }}
                </div>
        @endif
        
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-1">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb" class="nav-none-float">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="fa fa-home text-warning"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Produk
                            </li>
                        </ol>
                    </nav>
                </div>
                @if ($session['role_id'] == 2)
                    
                @else
                <div class="col-4 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-icon btn-neutral btn-round">
                        <span class="btn-inner--icon text-lg">
                            <i class="ni ni-fat-add text-warning"></i>
                        </span>
                    </a>
                </div>  
                @endif
            </div>
        </div>
        <form action="{{ route('carts.create') }}" method="POST">
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-product">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Action</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($products as $p)

                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ ucwords($p->name) }}</td>
                    <td>{{ $p->unit->category->name }}</td>
                    <td>{{ $p->unit->name }}</td>
                    <td>{{ $p->code_item }}</td>
                    <td>{{ $p->harga_jual }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only pt-2 text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('products.edit', $p->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                <div class="dropdown-item">
                                    <a href="javascript:;" data-id="{{ route('products.destroy', $p->id) }}" class="btn-danger badge badge-pill badge-danger">
                                        Delete
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input check-class" id="check-{{ $p->id }}" name="pesen[]" value="{{ $p->id }}" type="checkbox">
                            <label class="custom-control-label text-warning font-weight-bold pt-1" for="check-{{ $p->id }}">
                                Pesen
                            </label>
                        </div>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>

          @csrf
                <div class="col text-right">
                    <button type="submit" class="btn btn-icon btn-warning" style="border-radius: 22px;">
                        <span class="btn-inner--text">Pesan</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer">
          {{ $products->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>

<script>

    $(document).ready( function () {

        $('#table-product').DataTable({
            paging: false,
            searching: true,
        });

        $('.check-class').on('change', function(){
            var check = $(this).prop('checked');
            var val = $(this).val()
        });

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

