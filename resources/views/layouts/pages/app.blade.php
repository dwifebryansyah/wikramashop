@extends('layouts.element.main')

@section('title', 'Dashboard')

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
    // dd($session);
@endphp


@include('layouts.element.navbar')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            
        </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0 p-2">
          <div class="jumbotron">
            <h1 class="display-3 text-dark">
            
              Selamat Datang {{ ucwords($session['name']) }}
            </h1>
            <p class="lead text-dark">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <a class="btn btn-primary text-lg" href="javascript:;" role="button">Learn more</a>
          </div>
        </div>
        <div class="col-xl-4 mb-5 mb-xl-0 p-2">
          <div class="jumbotron">
            <h1 class="display-4 text-dark">Wikrama Untuk Indonesia!</h1>
            <p class="lead text-dark">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <a class="btn btn-primary text-lg" href="javascript:;" role="button">Almight</a>
          </div>
        </div>
      </div>
    </div>

@endsection
