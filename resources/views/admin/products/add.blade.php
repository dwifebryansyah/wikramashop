@extends('layouts.element.main')

@section('title', 'Produk - Add')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

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
                                <a class="text-warning" href="{{ route('products.index') }}">
                                    Produk
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Produk
                        </label>
                        <input type="text" autofocus name="name" class="form-control form-control-alternative" placeholder="Masukan Produk">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Kategori
                        </label>
                        <select name="category_id" id="category_id" class="form-control form-control-alternative">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Satuan
                        </label>
                        <select name="unit_id" id="unit_id" class="form-control form-control-alternative">
                            <option value="">Pilih Satuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Harga Beli
                        </label>
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp.
                                </span>
                            </div>
                            <input type="text" name="harga_beli" class="form-control form-control-alternative" placeholder="Masukan Harga Jual">
                        </div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Harga Jual
                        </label>
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp.
                                </span>
                            </div>
                            <input type="text" name="harga_jual" class="form-control form-control-alternative" placeholder="Masukan Harga Jual">
                        </div>            
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">
                            Stok
                        </label>
                        <input type="text" name="stok" class="form-control form-control-alternative" placeholder="Masukan Stok">
                    </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-icon btn-warning" style="border-radius: 22px;">
                        <span class="btn-inner--text">Submit</span>
                    </button>
                </div>
            </div>
            </form>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection


<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $( document ).ready(function() {

        $("#category_id").on("change",function(e){
            var thisId = $(this).val();

            $.ajax({
                url : "{{ url('getUnits') }}/" +thisId,
                dataType : 'json',
                type : 'get',
                beforeSend : function(e){
                    $("#unit_id option").first().html('Sedang memuat data satuan...');
                    $("#unit_id option,#district_id option").not(":first-child").remove();
                },
                success : function(response){
                    console.log(response)
                    $("#unit_id").html($("<option value=''>Pilih Satuan</option>"))
                    $.each(response.results,function(e,i){
                        $("#unit_id").append($("<option value='"+i.id+"'>"+i.name+"</option>"))
                    })
                }
            })
        });

        $("#unit_id").on("change",function(e){
            var thisId = $(this).val();

            $.ajax({
                url : "{{ url('getInformations') }}/" +thisId,
                dataType : 'json',
                type : 'get',
                beforeSend : function(e){
                    $("#jumlah_awal_id option").first().html('Sedang memuat data jumlah awal...');
                    $("#jumlah_awal_id option").not(":first-child").remove();
                },
                success : function(response){
                    //console.log(response)
                    $("#jumlah_awal_id").html($("<option value=''>Pilih Jumlah Awal Satuan</option>"))
                    $.each(response.results,function(e,i){
                        $("#jumlah_awal_id").append($("<option value='"+i.id+"'>"+i.jumlah_awal+' '+i.unit_one.name+' = '+i.jumlah_akhir+' '+i.unit_two.name+"</option>"))
                    })
                }
            })
        });

    });

</script>


