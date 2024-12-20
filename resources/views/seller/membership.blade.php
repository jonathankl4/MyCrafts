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
                        <div>
                            <div class="card-body">
                                <h2 class="card-title text-dark"> Membership </h2>
                                <div class="row">
                                    <!-- Free Package Card -->
                                    <div class="col-md-6 mb-3">
                                        <div class="card text-center">
                                            <div class="card-header bg-light">
                                                <h3>Membership Free</h3>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Gratis!</h5>
                                                <p class="card-text">
                                                    Dengan paket ini, Anda dapat melakukan:
                                                </p>
                                                <ul class="list-unstyled">
                                                    <li>- 5 transaksi penjualan</li>
                                                    <li>- Tambah Produk maksimal 3</li>
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
                                                <h3>Membership Pro</h3>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Mulai dari Rp 100.000</h5>
                                                <p class="card-text">
                                                    Dengan paket ini, Anda dapat menikmati:
                                                </p>
                                                <ul class="list-unstyled">
                                                    <li>- Transaksi penjualan tanpa batas</li>
                                                    <li>- Bisa Menambah produk sepuasnya</li>
                                                    <li>- Akses ke semua fitur( Master, Produksi, Gudang )</li>
                                                </ul>

                                            </div>
                                            <div class="card-footer">
                                                <span class="text-muted">Nikmati fitur tanpa batas!</span>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#modalPaketMembership">Beli Membership Pro</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>

        <div class="modal fade" id="modalPaketMembership" tabindex="-1" aria-labelledby="modalPaketMembershipLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Mengubah ukuran modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title" id="modalPaketMembershipLabel">Pilihan Membership Pro</h5> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class=" text-center mb-4" style="color: black">Pilih Paket Membership</h2>
                        <div class="row">
                            <!-- Paket 1 Bulan -->
                            <div class="col-md-4 mb-3">
                                <form action="{{ url('/seller/beliMembership') }}" method="post">
                                    @csrf
                                    <div class="card text-center h-100">
                                        <div class="card-header " style="background-color: #898063;color: white">
                                            <h3 style="color: white">Paket 1 Bulan</h3>
                                        </div>
                                        <div class="card-body">


                                            <br>
                                            <h5 class="card-title">Rp 100.000</h5>
                                            <p>Harga Normal</p>
                                            <input type="text" name="paket" id="" value="paket1" hidden >

                                        </div>
                                        <div class="card-footer">
                                            <button class="btn w-100" style="background-color: #7c7f5c; color: white">Beli
                                                Paket</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Paket 6 Bulan -->
                            <div class="col-md-4 mb-3">
                                <form action="{{url('/seller/beliMembership')}}" method="post">
                                    @csrf
                                <div class="card text-center h-100">
                                    <div class="card-header " style="background-color: #898063;color: white">
                                        <h3 style="color: white">Paket 6 Bulan</h3>
                                    </div>
                                    <div class="card-body">
                                        <br>
                                        <h5 class="card-title">Rp 500.000</h5>
                                        <p>Hemat Rp 100.000</p>
                                        <input type="text" name="paket" id="" value="paket2" hidden >
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn  w-100" style="background-color: #6b7f5a; color: white">Beli
                                            Paket</button>

                                    </div>
                                </div>
                            </form>
                            </div>
                            <!-- Paket 12 Bulan -->
                            <div class="col-md-4 mb-3">
                                <form action="{{url('/seller/beliMembership')}}" method="post">
                                    @csrf
                                <div class="card text-center h-100">
                                    <div class="card-header " style="background-color: #898063;color: white">
                                        <h3 style="color: white">Paket 12 Bulan</h3>
                                    </div>
                                    <div class="card-body">
                                        <br>
                                        <h5 class="card-title">Rp 900.000</h5>
                                        <p>Hemat Rp 300.000</p>
                                        <input type="text" name="paket" id="" value="paket3" hidden >
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn  w-100" style="background-color: #567f5c; color: white">Beli
                                            Paket</button>

                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
