@extends('template.MasterDesain')

@section('title', 'Dashboard')

@section('style')

<style>
    .card-header {
        border-bottom: none;
    }
    .card {
        border-radius: 10px;
    }

</style>
@endsection

@section('sidebar')

    @include('seller.template.sidebar')

@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection


@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #bfb596">
                        <h2 class="mb-0 text-dark">Dashboard Penjual</h2>
                        <div class="badge bg-white text-dark">
                            {{ date('d M Y') }}
                        </div>
                    </div>
                    <br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title text-muted mb-2">Status Membership</h5>
                                                @if ($toko->status == 'Pro')
                                                    <div class="alert alert-success p-2" role="alert">
                                                        <i class="bx bx-check-circle me-1"></i>
                                                        Membership Pro
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        Berlaku hingga:
                                                        <strong>{{ $toko->membership_expires_at }}</strong>
                                                    </p>
                                                @elseif ($toko->status == 'Free')
                                                    <div class="alert alert-warning p-2" role="alert">
                                                        <i class="bx bx-info-circle me-1"></i>
                                                        Membership Gratis
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        Tingkatkan ke Pro untuk fitur lebih lengkap
                                                    </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted mb-3">Statistik Penjualan</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>

                                                <h3 class="mb-0"style="color: black">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</h3>
                                                <small class="text-muted">Total Penjualan Bulan Ini</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-label-success p-2">
                                                    <i class="bx bx-chart fs-4"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted mb-3">Produk</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                @php

                                                    // count untuk total semua
                                                    $p1 = count($nonCustom);
                                                    $p2 = count($custom);
                                                    // count untuk total yang aktif
                                                    $a1 =

                                                    $total_produk = $p1+$p2;
                                                @endphp
                                                <h3 class="text-primary mb-1">{{ $total_produk ?? 0 }}</h3>
                                                <small class="text-muted">Total Produk Aktif</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-label-info p-2">
                                                    <i class="bx bx-package fs-4"></i>
                                                </span>
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
    </div>

    <footer class="content-footer footer bg-footer-theme text-center py-3">
        <div class="container-xxl">
            <span class="text-muted">© {{ date('Y') }} MyCrafts.</span>
        </div>
    </footer>
</div>
@endsection
