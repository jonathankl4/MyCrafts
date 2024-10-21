@extends('template.MasterDesain')

@section('title', 'Dashboard')

@section('sidebar')

@include('seller.template.sidebar')

@endsection

@section('navbar')
@include('seller.template.navbar')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div>
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div >
                        <div class="card-body" >
                            <h2 class="card-title text-primary"> Membership {{$user->username}} </h2>
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
                                                <li>- Tambah Produk Custom maksimal 1</li>
                                                <li>- Hanya bisa akses Fitur Penjualan</li>
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
                                                <li>- Bisa Menambah semua Produk Custom</li>
                                                <li>- Akses ke semua fitur penunjang( Master, Produksi, Gudang )</li>
                                            </ul>
                                        </div>
                                        <div class="card-footer">
                                            <span class="text-muted">Nikmati fitur tanpa batas!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
  </div>
@endsection
