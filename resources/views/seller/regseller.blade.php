
@extends('template.BackupMasterDesain')

@section('title', 'Dashboard')
{{--
@section('sidebar')
@include('customer.template.sidebar')
@endsection --}}

@section('navbar')
@include('seller.template.navbar')
@endsection


@section('content')


<div class="content-wrapper">
    <!-- Content -->
    <center>

    <div class="container-xxl flex-grow-1 container-p-y">


<div class="row mb-5">


        <div class="">
          <div class="card text-center">
            <div class="card-header"><h2>Seller</h2></div>
            <div class="card-body">
              <h5 class="card-title">Mulai berjualan dan raih keuntungan</h5>
              <p class="card-text">daftar sekarang</p>
              {{-- <a href="{{route('becomeSeller')}}" class="btn btn-success">Daftar</a> --}}
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Daftar
              </button>
            </div>
            <div class="card-footer text-muted">MyCraft</div>
          </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{route('becomeSeller')}}" class="btn btn-primary">Save changes</a>
            </div>
          </div>
        </div>
    </div>


    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</center>
</div>
@endsection





