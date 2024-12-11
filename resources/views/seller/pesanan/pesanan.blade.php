@extends('template.MasterDesain')

@section('title', 'Daftar Pesanan')

@section('style')
    <style>
        .nav-tabs {
            border-bottom: 2px solid #E5E7EB;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6B7280;
            font-weight: 500;
            padding: 0.75rem 1rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            color: #111827;
        }

        .nav-tabs .nav-link.active {
            color: #898063;
            background: none;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #898063;
        }

        .nav-pills {
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .nav-pills .nav-link {
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #6B7280;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link:hover {
            background-color: #F3F4F6;
        }

        .nav-pills .nav-link.active {
            background-color: #898063;
            color: white;
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
        <!-- Content -->

        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Daftar Pesanan</h2>


            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a> --}}
            <div class="">



                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'semua' ? 'active' : '' }}"
                                href="{{ url('/seller/pesanan?status=semua') }}">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'berjalan' ? 'active' : '' }}"
                                href="{{ url('/seller/pesanan?status=berjalan') }}">
                                Berjalan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'berhasil' ? 'active' : '' }}"
                                href="{{ url('/seller/pesanan?status=berhasil') }}">
                                Berhasil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'tidak_berhasil' ? 'active' : '' }}"
                                href="{{ url('/seller/pesanan?status=tidak_berhasil') }}">
                                Tidak Berhasil
                            </a>
                        </li>
                    </ul>
                    @if ($status == 'berjalan')
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == null ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan') }}">
                                    Semua
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == 'menunggu_konfirmasi' ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan&sub_status=menunggu_konfirmasi') }}">
                                    Menunggu Konfirmasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == 'menunggu_pembayaran' ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan&sub_status=menunggu_pembayaran') }}">
                                    Menunggu Pembayaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == 'sedang_produksi' ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan&sub_status=sedang_produksi') }}">
                                    Dalam Produksi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == 'siap_dikirim' ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan&sub_status=siap_dikirim') }}">
                                    Siap Dikirim
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $sub_status == 'dikirim' ? 'active' : '' }}"
                                    href="{{ url('/seller/pesanan?status=berjalan&sub_status=dikirim') }}">
                                    Dikirim
                                </a>
                            </li>
                        </ul>
                    @endif


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
                                    <td style="display: none">{{ $pembelian[$i]->tgl_transaksi }}</td>
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
                                            $status = 'Menunggu Konfirmasi';
                                            $color = 'bg-warning';
                                        } elseif ($s == 2) {
                                            $status = 'Perbaikan Add-On, Menunggu Pembayaran';
                                            $color = 'bg-secondary';
                                        } elseif ($s == 3) {
                                            $status = 'Menunggu Pembayaran Customer';
                                            $color = 'bg-info';
                                        } elseif ($s == 4) {
                                            $status = 'Dalam Proses Produksi';
                                            $color = 'bg-success';
                                        } elseif ($s == 5) {
                                            $status = 'Produksi Selesai';
                                            $color = 'bg-dark';
                                        } elseif ($s == 6) {
                                            $status = 'Dalam Pengiriman';
                                            $color = 'bg-dark';
                                        } elseif ($s == 7) {
                                            $status = 'Pesanan Selesai';
                                            $color = 'bg-success';
                                        } elseif ($s == 8) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-danger';
                                        } elseif ($s == 9) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-danger';
                                        } elseif ($s == 10) {
                                            $status = 'Pesanan Batal';
                                            $color = 'bg-danger';
                                        }elseif ($s == 11) {
                                            $status = 'Siap Dikirim';
                                            $color = 'bg-warning';
                                        } elseif ($s == 12) {
                                            $status = 'Barang Sampai';
                                            $color = 'bg-warning';
                                        } elseif ($s == 13) {
                                            $status = 'Customer Mengajukan Retur';
                                            $color = 'bg-warning';
                                        } elseif ($s == 14) {
                                            $status = 'Retur Diterima, Menunggu Pengiriman';
                                            $color = 'bg-warning';
                                        } elseif ($s == 15) {
                                            $status = 'Dalam Pengiriman (Retur)';
                                            $color = 'bg-warning';
                                        } elseif ($s == 16) {
                                            $status = 'Retur Ditolak, Transaksi Selesai';
                                            $color = 'bg-warning';
                                        }

                                    @endphp
                                    <td style="font-size: 16px"><b><span
                                                class="badge {{ $color }}">{{ $status }}</span></b></td>

                                    <td>

                                        <a href="{{ url('seller/pesanan/detailPesanan/' . $pembelian[$i]->id) }}"
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
                order: [
                    [0, "desc"]
                ],
                pageLength: 10,
                columnDefs: [{
                    targets: 0,
                    visible: false // Hide the date column used for sorting
                }],
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
                    searchInput.attr('placeholder',
                        'Cari berdasarkan nama produk, tipe, atau status...');

                    // Add search highlight
                    searchInput.on('keyup', function() {
                        $('.highlight').contents().unwrap();
                        var searchTerm = this.value;
                        if (searchTerm) {
                            $('.order-card').find('h4, p, span').each(function() {
                                var text = $(this).text();
                                if (text.toLowerCase().indexOf(searchTerm
                                .toLowerCase()) >= 0) {
                                    var regex = new RegExp('(' + searchTerm + ')',
                                    'gi');
                                    $(this).html(text.replace(regex,
                                        '<span class="highlight">$1</span>'));
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>


@endsection
