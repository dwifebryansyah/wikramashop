@extends('layouts.element.main')

@section('title', 'Pemesanan')

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
<div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
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
                                    <i class="fa fa-home text-warning"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">
                                Pemesanan
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-icon btn-neutral btn-round">
                        <span class="btn-inner--text">Add</span>
                        <span class="btn-inner--icon">
                            <i class="ni ni-fat-add"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-cart">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($carts as $c)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ ucwords($c->product->name.' - '.$c->product->unit->name) }}</td>
                    <td>{{ $c->product->harga_jual }}</td>
                    <td>{{ $c->qty }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only pt-2 text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('categories.edit', $c->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                <div class="dropdown-item">
                                    <a href="{{ route('categories.destroy', $c->id) }}" class="badge badge-pill badge-danger">
                                        Delete
                                    </a>
                                </div>
                            </div>
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
            {{ $carts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {

        $('#table-cart').DataTable({
            paging: false,
            searching: true,
        });
    } );

</script>
