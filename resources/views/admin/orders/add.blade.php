@extends('layouts.element.main')

@section('title', 'Pembelian')

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
    // dd($session)
@endphp

@include('layouts.element.navbar')
<!-- Header -->
<div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7 pb-4">
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="fa fa-home text-warning"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pembelian
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">

                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-category">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
            <form action="{{ route('orders.store') }}" method="POST">
            @csrf
                @php
                    $no = 1;
                    $cek = $carts->all() == [];
                @endphp
                @foreach ($carts as $c)
                <tr>
                    <td>
                        {{ $no }}
                        <input type="hidden" name="Order[{{ $c->id }}][product_id]" value="{{ $c->product->id }}">
                        <input type="hidden" name="Order[{{ $c->id }}][qty]" value="{{ $c->qty }}">
                    </td>
                    <td>{{ ucwords($c->product->name.' - '.$c->product->unit->name) }}</td>
                    <td>Rp. {{ number_format($c->product->harga_jual) }}</td>
                    <td>{{ $c->qty }}</td>
                    <td>Rp. {{ number_format($c->qty * $c->product->harga_jual) }}</td>
                    <td>
                        <a href="javascript:;" data-id="{{ route('orders.destroy', $c->id) }}" class="btn-danger badge badge-pill badge-danger">
                            Cancel
                        </a>
                        <a href="{{ route('carts.edit', $c->product->id) }}" class="badge badge-pill badge-primary">
                            Pesen
                        </a>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer pt-4 pb-4 pr-5">
            @if ($cek)

            @else
            <div class="row" id="form-pembelian">
                <div class="col-7"></div>
                <div class="col-5 p-4 bg-warning">
                    <div class=" pb-3">
                        <h2 class="text-white font-weight-light">
                            <strong>
                                TOTAL KERANJANG
                            </strong>
                        </h2>
                    </div>

                    

                    <div class="d-flex justify-content-between align-items-center pb-1">
                        <div>
                            <h2 class="text-white font-weight-light">
                                <strong>
                                    SUBTOTAL
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-white font-weight-light">
                                <strong>
                                    Rp.{{ number_format( $subtotal ) }}
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                </strong>
                            </h2>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pb-2">
                        <div>
                            <h2 class="text-white font-weight-light">
                                <strong>
                                    Bayar
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-red font-weight-light">
                                <strong>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rp.
                                                </span>
                                            </div>
                                            <input type="text" required autocomplete="off" name="duit" placeholder="Uang Bayar" class="form-control form-control-alternative">
                                        </div>      
                                    </div>
                                </strong>
                            </h2>
                        </div>
                    </div>

                    <div>
                        <input type="hidden" name="user" value="{{ $session['user_id'] }}">
                        <input type="hidden" name="activity" value="membayar">
                        <button class="btn btn-white btn-lg btn-block text-warning text-lg font-weight-bold">
                            Bayar
                        </button>
                    </div>
                </div>
            </div>
            @endif

        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {

        $('#pembeli-title').hide();
        $('#pembeli-form').hide();

        $('#orang-dekat-id').on('change', function(){

            var check = $(this).prop('checked');

            if(check){
                $('#pembeli-title').show();
                $('#pembeli-form').show();
            }else{
                $('#pembeli-title').hide();
                $('#pembeli-form').hide();
            }

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

    });

</script>
