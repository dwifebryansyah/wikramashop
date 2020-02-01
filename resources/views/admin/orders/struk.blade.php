@extends('layouts.element.custom_main')

@section('title', 'Struk')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }

        .pr-50{
            padding-right: 50px;
        }

        .pr-150{
            padding-right: 150px;
        }

        .pr-100{
            padding-right: 100px;
        }

        .pl-50{
            padding-left: 50px;
        }

        .pl-150{
            padding-left: 150px;
        }

        .pl-100{
            padding-left: 100px;
        }
    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp


<!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">

    </div>

<!-- Page content -->
<div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-10 col-md-10">
            <div class="card bg-gradient-white shadow border-0">
              <div class="card-body px-lg-5 py-lg-5">
                  <div class="jumbotron jumbotron-fluid px-3 py-3 bg-gradient-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('orders.print', $order->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                    CETAK PDF
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <p class="mt-3">
                            Wikrama Shop
                            <br>
                            Jl Raya Wangun Sindangsari Kec. Bogor Timur 16146
                            <br>
                            Telp/Fax. : 0251-8242411
                            <br>
                            {{ $order->code_report }}
                        </p>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">Nama Barang</div>
                                <div class="col-md-2">Jumlah</div>
                                <div class="col-md-2">Harga</div>
                                <div class="col-md-2">Subtotal</div>
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                @foreach ($data as $od)
                                <div class="col-md-6">{{ ucwords($od->product->name.' - '.$od->product->unit->name) }}</div>
                                <div class="col-md-2">{{ $od->qty }}</div>
                                <div class="col-md-2">{{ $od->product->harga_jual }}</div>
                                <div class="col-md-2">{{ $od->product->harga_jual * $od->qty }}</div>
                                @endforeach
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    @if ($data2->code_debt)
                                    Rp {{ number_format($data2->sisa_bayar) }}
                                    @else
                                    Rp {{ number_format($data2->total_harga) }}
                                    @endif

                                </div>

                                <div class="col-md-6">Tunai</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    Rp {{ number_format($data2->total_bayar) }}
                                </div>

                                <div class="col-md-6">Kembalian</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    Rp {{ number_format($data2->kembalian) }}
                                </div>
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <p class="text-center font-weight-bold">
                                        Terima Kasih & Selamat Berbelanja Kembali
                                        <br><br>
                                        Pembeli Adalah Raja Kami
                                    </p>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </div>
      </div>

@endsection

@section('scripts')

<script>

    $(document).ready( function () {

    } );

</script>

@endsection
