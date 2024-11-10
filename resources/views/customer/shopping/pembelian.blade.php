@extends('template.shoppingTemplate')

@section('title', 'MyCrafts - Purchase History')

@section('style')
<style>
    /* Keep existing styles from before */
    .order-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }

    /* ... (keep other existing styles) ... */
    .product-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .status-menunggu {
        background-color: #FEF3C7;
        color: #92400E;
    }

    .status-produksi {
        background-color: #DBEAFE;
        color: #1E40AF;
    }

    .status-siap {
        background-color: #D1FAE5;
        color: #065F46;
    }

    .status-dikirim {
        background-color: #E0E7FF;
        color: #3730A3;
    }

    .status-selesai {
        background-color: #DCF7E3;
        color: #166534;
    }

    .status-batal {
        background-color: #FEE2E2;
        color: #991B1B;
    }

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

    .price-label {
        color: #6B7280;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .price-value {
        font-weight: 600;
        color: #111827;
    }

    .detail-link {
        color: #898063;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .detail-link:hover {
        color: #6B6343;
        text-decoration: underline;
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

    /* DataTable Custom Styling */
    .dataTables_wrapper .dataTables_length select {
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        border-radius: 0.375rem;
        border-color: #D1D5DB;
    }

    .dataTables_wrapper .dataTables_filter input {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        border: 1px solid #D1D5DB;
        margin-left: 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        border: 1px solid #D1D5DB;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #898063;
        color: white !important;
        border-color: #898063;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 1rem;
        color: #6B7280;
    }

    /* DataTable specific styling */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1.5rem;
        width: 100%;
        text-align: left;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 300px;
        padding: 0.5rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        margin-left: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length {
        margin-bottom: 1.5rem;
    }

    .dataTables_wrapper .dataTables_length select {
        padding: 0.5rem;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        margin: 0 0.5rem;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 1rem;
        color: #6B7280;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 6px;
        border: 1px solid #E5E7EB;
        background: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #898063;
        color: white !important;
        border-color: #898063;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #F3F4F6;
        color: #111827 !important;
    }

    /* Search Results Highlight */
    .highlight {
        background-color: #FEF3C7;
        padding: 0.125rem 0.25rem;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<br><br><br><br>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 fw-bold">Pembelian</h1>

            <!-- Main Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'semua' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=semua') }}">
                        Semua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'berjalan' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan') }}">
                        Berjalan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'berhasil' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berhasil') }}">
                        Berhasil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'tidak_berhasil' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=tidak_berhasil') }}">
                        Tidak Berhasil
                    </a>
                </li>
            </ul>

            <!-- Sub-status Pills -->
            @if($status == 'berjalan')
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == null ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan') }}">
                        Semua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == 'menunggu_konfirmasi' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan&sub_status=menunggu_konfirmasi') }}">
                        Menunggu Konfirmasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == 'menunggu_pembayaran' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan&sub_status=menunggu_pembayaran') }}">
                        Menunggu Pembayaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == 'sedang_produksi' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan&sub_status=sedang_produksi') }}">
                        Sedang Produksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == 'siap_dikirim' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan&sub_status=siap_dikirim') }}">
                        Siap Dikirim
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $sub_status == 'dikirim' ? 'active' : '' }}"
                       href="{{ url('/customer/pembelian?status=berjalan&sub_status=dikirim') }}">
                        Dikirim
                    </a>
                </li>
            </ul>
            @endif

            <!-- DataTable Container -->
            <div class="table-responsive">
                <table id="orderTable" class="w-100">
                    <thead style="display: none">
                        <!-- Hidden header for DataTable structure -->
                        <tr>
                            <th>Date</th>
                            <th>Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelian as $order)
                        <tr>
                            <td>{{ $order->tgl_transaksi }}</td>
                            <td>
                                <div class="order-card">
                                    <div class="p-4">
                                        <div class="row align-items-center">
                                            <!-- Image -->


                                            <!-- Order Details -->
                                            <div class="col-md-5">
                                                <h4 class="mb-2">{{ $order->nama_produk }}</h4>
                                                <p class="mb-1 text-muted">
                                                    {{ \Carbon\Carbon::parse($order->tgl_transaksi)->translatedFormat('j F Y, H:i') }}
                                                </p>
                                                <p class="mb-0">
                                                    <span class="badge {{ $order->tipe_trans == 'custom' ? 'bg-warning' : 'bg-info' }}">
                                                        {{ ucfirst($order->tipe_trans) }}
                                                    </span>
                                                </p>
                                            </div>

                                            <!-- Pricing -->
                                            <div class="col-md-4">
                                                @if ($order->tipe_trans == 'custom')
                                                <div class="mb-2">
                                                    <div class="price-label">Perkiraan Harga:</div>
                                                    <div class="price-value">
                                                        Rp. {{ number_format($order->perkiraan_harga, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="mb-2">
                                                    <div class="price-label">Harga Final:</div>
                                                    <div class="price-value">
                                                        {{ $order->harga <= 0 ? 'Belum ada' : 'Rp. ' . number_format($order->harga + $order->ongkir, 0, ',', '.') }}
                                                    </div>
                                                </div>

                                                @if ($order->harga_redesain != null)
                                                <div>
                                                    <div class="price-label">Harga Redesain:</div>
                                                    <div class="price-value">
                                                        Rp. {{ number_format($order->harga_redesain + $order->ongkir, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <!-- Status and Actions -->
                                            <div class="col-md-3 text-end">
                                                @php
                                                    $statusClass = match($order->status) {
                                                        1, 11 => 'status-menunggu',
                                                        2 => 'status-menunggu',
                                                        3 => 'status-menunggu',
                                                        4 => 'status-produksi',
                                                        5 => 'status-siap',
                                                        6 => 'status-dikirim',
                                                        7 => 'status-selesai',
                                                        8, 9 => 'status-batal',
                                                        default => ''
                                                    };

                                                    $statusText = match($order->status) {
                                                        1, 11 => 'Menunggu Konfirmasi',
                                                        2 => 'Perbaikan Desain, Bayar',
                                                        3 => 'Menunggu Pembayaran',
                                                        4 => 'Sedang Produksi',
                                                        5 => 'Siap Dikirim',
                                                        6 => 'Dalam Pengiriman',
                                                        7 => 'Selesai',
                                                        8, 9 => 'Dibatalkan',
                                                        default => 'Unknown'
                                                    };
                                                @endphp

                                                <div class="status-badge {{ $statusClass }} mb-3">
                                                    {{ $statusText }}
                                                </div>

                                                <a href="{{ url($order->tipe_trans == 'custom' ? '/detailTransaksiCustom/' : '/detailTransaksiNonCustom/').'/' . $order->id }}"
                                                   class="detail-link">
                                                    Lihat Detail →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
