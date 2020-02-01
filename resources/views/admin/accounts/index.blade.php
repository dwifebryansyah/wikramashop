@extends('layouts.element.main')

@section('title', 'Akun')

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
                                Akun
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('adminAccount.create') }}" class="btn btn-icon btn-neutral btn-round">
                        {{-- <span class="btn-inner--text">Add</span> --}}
                        <span class="btn-inner--icon text-lg">
                            <i class="ni ni-fat-add text-info"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-account">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Hak Akses</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($accounts as $a)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->roles->first()->name }}</td>
                    @if ($a->status == 0)
                    <td>
                        <span class="badge badge-pill badge-warning">Pending</span>
                    </td>
                    @else
                    <td>
                        <span class="badge badge-pill badge-success">Accept</span>
                    </td>
                    @endif

                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only pt-2 text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                <div class="dropdown-item">
                                    <a href="{{ route('adminAccount.edit', $a->id) }}" class="badge badge-pill badge-success">
                                        Edit
                                    </a>
                                </div>
                                <div class="dropdown-item">
                                    <a href="#" data-id="{{ route('adminAccount.destroy', $a->id) }}" class="btn-danger badge badge-pill badge-danger">
                                        Delete
                                    </a>
                                </div>
                                @if ($a->status == 0)
                                <div class="dropdown-item">
                                    <a href="{{ route('adminAccount.accept', $a->id) }}" class="badge badge-pill badge-primary">
                                        Terima Akun
                                    </a>
                                </div>
                                @else
                                @endif
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
            {{ $accounts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $(document).ready( function () {

        $('#table-account').DataTable({
            paging: false,
            searching: true,
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

    });

</script>
