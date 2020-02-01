@extends('layouts.element.main')

@section('title', 'Laporan')

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
                                Laporan
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12 p-1">
                        <div class="form-group">
                            <label class="form-control-label">
                                Jenis Laporan
                            </label>
                            <select name="jenis_laporan" id="jenisLaporan-id" required class="form-control form-control-alternative">
                                <option value="">Pilih Jenis Laporan</option>
                                <option value="mingguan">Mingguan</option>
                                <option value="bulanan">Bulanan</option>
                                <option value="harian">Harian</option>
                            </select>
                        </div>
                     </div>
                     <div class="col-md-6 p-1" id="laporan-id">
                        <div class="form-group">
                            <label class="form-control-label">
                                Laporan
                            </label>
                            <select name="laporan" id="select-laporan-id" required class="form-control form-control-alternative">
                                <option value="">Pilih Laporan</option>
                                <option value="barang">Barang</option>
                                <option value="pasok">Pasok</option>
                            </select>
                        </div>
                     </div>
                     <div class="col-md-6" id="month-id">
                        <div class="form-group p-1">
                            <label class="form-control-label">
                                Bulan
                            </label>
                            <input type="month" value="{{ $monthNow }}" name="month" class="form-control form-control-alternative">
                        </div>
                     </div>
                     <div class="col-md-6" id="week-id">
                        <div class="form-group p-1">
                            <label class="form-control-label">
                                Week
                            </label>
                            <input type="week" value="{{ $weekNow }}" name="week" class="form-control form-control-alternative">
                        </div>
                     </div>
                     <div class="col-md-6" id="day-id">
                        <div class="form-group p-1">
                            <label class="form-control-label">
                                Hari
                            </label>
                            <input type="date" name="day" value="{{ $dayNow }}" class="form-control form-control-alternative">
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                         <button class="btn btn-info" formtarget="_blank " id="button-id">Print</button>
                     </div>
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

        $('#week-id').hide();
        $('#month-id').hide();
        $('#day-id').hide();
        $('#laporan-id').hide();

        var values_1 = $('#jenisLaporan-id').val();
        var values_2 = $('#select-laporan-id').val();
        //console.log(values_2);

        if(values_1 == ''){
            $('#button-id').prop('disabled', true);
        }else{
            $('#button-id').prop('disabled', false);
        }

        $('#jenisLaporan-id').on('change', function(){
            var value = $(this).val();

            if(value == 'mingguan'){
                $('#button-id').prop('disabled', false);

                $('#laporan-id').show();
                $('#week-id').show();
                $('#month-id').hide();
                $('#day-id').hide();
            }else if(value == 'harian'){
                $('#laporan-id').show();
                $('#button-id').prop('disabled', false);
                $('#day-id').show();
                $('#month-id').hide();
                $('#week-id').hide();
            }else if(value == 'bulanan'){
                $('#laporan-id').show();
                $('#button-id').prop('disabled', false);
                $('#month-id').show();
                $('#week-id').hide();
                $('#day-id').hide();
            }else{
                $('#button-id').prop('disabled', true);
                $('#week-id').hide();
                $('#day-id').hide();
                $('#month-id').hide();
                $('#laporan-id').hide();
            }

            if(values_2 == ''){
                $('#button-id').prop('disabled', true);
            }else{
                $('#button-id').prop('disabled', false);
            }

        })

        $('#select-laporan-id').on('change', function(){
            var values = $(this).val();

            if(values == 'barang'){
                $('#button-id').prop('disabled', false);
            }else if(values == 'pasok'){
                $('#button-id').prop('disabled', false);
            }else{
                $('#button-id').prop('disabled', true);
            }
        })

    } );

</script>
