
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
            <div class="row">
                <!-- Free Package Card -->
                <div class="col-md-6 mb-3">
                    <div class="card text-center">
                        <div class="card-header bg-light">
                            <h3>Paket Free</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Gratis!</h5>
                            <p class="card-text">
                                Dengan paket ini, Anda dapat melakukan:
                            </p>
                            <ul class="list-unstyled">
                                <li>- 5 transaksi penjualan</li>
                                <li>- Menambah 5 produk</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <span class="text-muted">Batasan fitur berlaku</span>
                        </div>
                    </div>
                </div>

                <!-- Paid Package Card -->
                <div class="col-md-6 mb-3">
                    <div class="card text-center">
                        <div class="card-header bg-light">
                            <h3>Paket Premium</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp 100.000/bulan</h5>
                            <p class="card-text">
                                Dengan paket ini, Anda dapat menikmati:
                            </p>
                            <ul class="list-unstyled">
                                <li>- Transaksi penjualan tanpa batas</li>
                                <li>- Menambah produk tanpa batas</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <span class="text-muted">Nikmati fitur tanpa batas!</span>
                        </div>
                    </div>
                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Daftar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Pembayaran Membership bisa dilakukan setelah daftar
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{route('becomeSeller')}}" class="btn btn-primary">Daftar</a>
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





