@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

@section('style')
    <style>
      
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
        <!-- Content -->

        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Daftar Pesanan</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}
            <div class="">

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">

                            <a href="{{ url('/seller/pesanan') }}" class="nav-link active">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/nonCustom') }}" class="nav-link">
                                Non Custom
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/custom') }}" class="nav-link">
                                Custom
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/produksi') }}" class="nav-link">
                                Proses Produksi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/siapDikirim') }}" class="nav-link">
                                Siap Dikirim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/dalamPengiriman') }}" class="nav-link">
                                Dalam Pengiriman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/selesai') }}" class="nav-link">
                                Pesanan Selesai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/seller/pesanan/batal') }}" class="nav-link">
                                Dibatalkan
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="card" style="padding: 15px">
                <h5 class="card-header"></h5>



                {{-- ini jika mau table nya responsive --}}
                {{-- <div class="table-responsive text-nowrap p-3"> --}}
                <div class="table-responsive">
                    <table id="orderTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="display: none">date</th>
                                <th>Nama Produk</th>
                                <th>Tipe Transaksi</th>
                                <th>Tanggal Transaksi</th>

                                <th>Status Pesanan</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

                            @for ($i = 0; $i < count($pembelian); $i++)
                                <tr>
                                    <td style="display: none">{{$pembelian[$i]->tgl_transaksi}}</td>
                                    <td style="font-size: 16px"><b>{{ $pembelian[$i]->nama_produk }}</b></td>
                                    <td style="font-size: 16px"><b>{{ $pembelian[$i]->tipe_trans }}</b></td>
                                    <td style="font-size: 16px">
                                        <b>{{ \Carbon\Carbon::parse($pembelian[$i]->tgl_transaksi)->translatedFormat('j F Y') }}</b>
                                    </td>

                                    @php
                                        $s = $pembelian[$i]->status;
                                        $status = '';
                                        $color = '';
                                        if ($s == 1) {
                                            $status = 'Belum Di konfirmasi';
                                            $color = 'bg-warning';
                                        } elseif ($s == 2) {
                                            $status = 'Pengajuan Perbaikan desain, Menunggu Pembayaran';
                                            $color = 'bg-secondary';
                                        } elseif ($s == 3) {
                                            $status = 'Menunggu Pembayaran Customer';
                                            $color = 'bg-info';
                                        } elseif ($s == 4) {
                                            $status = 'Dalam Proses Produksi';
                                            $color = 'bg-success';
                                        } elseif ($s == 5) {
                                            $status = 'Siap Dikirim';
                                            $color = 'bg-dark';
                                        } elseif ($s == 6) {
                                            $status = 'Dalam Pengiriman';
                                            $color = 'bg-dark';
                                        } elseif ($s == 7) {
                                            $status = 'Pesanan Selesai';
                                            $color = 'bg-dark';
                                        } elseif ($s == 8) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-dark';
                                        } elseif ($s == 9) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-dark';
                                        } elseif ($s == 11) {
                                            $status = 'Belum di Konfirmasi';
                                            $color = 'bg-warning';
                                        }

                                    @endphp
                                    <td style="font-size: 16px"><b><span
                                                class="badge {{ $color }}">{{ $status }}</span></b></td>

                                    <td>

                                        <a href="{{ url('seller/detailPesanan/' . $pembelian[$i]->id) }}"
                                            class="btn btn-info">Detail Pesanan</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>

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

@section('script')
    <script>
        $(document).ready(function() {
    // Initialize DataTable with custom configuration
    var table = $('#orderTable').DataTable({
        order: [[0, "desc"]],
        pageLength: 10,
        columnDefs: [
            {
                targets: 0,
                visible: false // Hide the date column used for sorting
            }
        ],
        dom: '<"top"lf>rt<"bottom"ip>', // Custom DOM positioning
        language: {
            search: "Cari pesanan:",
            lengthMenu: "Tampilkan _MENU_ pesanan per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pesanan",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        initComplete: function() {
            // Enhance search functionality
            var searchInput = $('.dataTables_filter input');
            searchInput.attr('placeholder', 'Cari berdasarkan nama produk, tipe, atau status...');

            // Add search highlight
            searchInput.on('keyup', function() {
                $('.highlight').contents().unwrap();
                var searchTerm = this.value;
                if (searchTerm) {
                    $('.order-card').find('h4, p, span').each(function() {
                        var text = $(this).text();
                        if (text.toLowerCase().indexOf(searchTerm.toLowerCase()) >= 0) {
                            var regex = new RegExp('(' + searchTerm + ')', 'gi');
                            $(this).html(text.replace(regex, '<span class="highlight">$1</span>'));
                        }
                    });
                }
            });
        }
    });
});
    </script>


@endsection
