@extends('layouts.element.main')

@section('title', 'Pembelian - Edit')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection
@php
    $session = Session::get('user');
@endphp
@section('content')

<!-- Navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 mt-3 text-white text-uppercase d-none d-lg-inline-block" href="javascript:;">
      Dashboard
    </a>
  </div>
</nav>
<!-- End Navbar -->
<!-- Header -->
<div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
          <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-bottom-1">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fa fa-home text-warning"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-warning" href="{{ route('orders.create') }}">
                                    Pembelian
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('carts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Produk
                        </label>
                        
                        <input type="text" readonly name="name" value="{{ ucwords($product->name.' - '.$product->unit->name) }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Stok
                        </label>
                        <input type="text" id="stok-id" readonly name="stok" value="{{ $product->stok }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-12 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Pesen Berapa Produk
                        </label>
                        <input type="hidden" name="pesen[{{ $product->id }}][id]" value="{{ $product->id }}" class="form-control form-control-alternative">
                        <input type="text" autofocus name="pesen[{{ $product->id }}][qty]" value="{{ $qty }}" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col text-right">
                    <input type="hidden" name="role" value="{{ $session['role_id'] }}">
                    <input type="hidden" name="activity" value="mengubah">
                    <button type="submit" id="btn-add" class="btn btn-icon btn-warning" style="border-radius: 22px;">
                        <span class="btn-inner--text">Submit</span>
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-footer py-4">

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {


    } );

</script>
