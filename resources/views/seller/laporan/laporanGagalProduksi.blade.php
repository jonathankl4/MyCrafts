@extends('template.LaporanTemplate')

@section('title', 'Laporan Gagal Produksi')

@section('style')
<style>
    .table-responsive {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .page-header {
        color: #2c3e50;
        border-bottom: 2px solid #eee;
        margin-bottom: 1.5rem;
    }

    .filter-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
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
    <div class="container-fluid px-4 py-3">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header fw-bold py-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>Laporan Gagal Produksi
                </h2>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-times-circle me-2"></i>Total Kegagalan
                                </h5>
                                <h3 class="mb-0">{{ $laporanGagalProduksi->sum('jumlah_gagal') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-percentage me-2"></i>Tingkat Kegagalan
                                </h5>
                                <h3 class="mb-0">
                                    {{ number_format(($laporanGagalProduksi->sum('jumlah_gagal') / $laporanGagalProduksi->sum('jumlahdiproduksi')) * 100, 1) }}%
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-calendar me-2"></i>Total Periode
                                </h5>
                                <h3 class="mb-0">{{ $laporanGagalProduksi->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-box me-2"></i>Total Produksi
                                </h5>
                                <h3 class="mb-0">{{ number_format($laporanGagalProduksi->sum('jumlahdiproduksi')) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section mb-4">
                    <form method="GET" action="{{ route('laporan-gagal-produksi.index') }}" class="row g-3">
                        <div class="col-md-5">
                            <label for="start_date" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Tanggal Awal:
                            </label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-5">
                            <label for="end_date" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Tanggal Akhir:
                            </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="failureTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Target Produksi</th>
                                        <th class="text-center">Berhasil</th>
                                        <th class="text-center">Gagal</th>
                                        <th class="text-center">Tingkat Kegagalan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanGagalProduksi as $item)
                                    @php
                                        $failureRate = ($item->jumlah_gagal / $item->jumlahdiproduksi) * 100;
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_produksi_mulai)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_produksi_selesai)->format('d M Y') }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td class="text-center">{{ number_format($item->jumlahdiproduksi) }}</td>
                                        <td class="text-center text-success">{{ number_format($item->jumlah_berhasil) }}</td>
                                        <td class="text-center text-danger">{{ number_format($item->jumlah_gagal) }}</td>
                                        <td class="text-center">
                                            <span class="status-badge bg-danger text-white">
                                                {{ number_format($failureRate, 1) }}%
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">{{ number_format($laporanGagalProduksi->sum('jumlahdiproduksi')) }}</td>
                                        <td class="text-center fw-bold text-success">{{ number_format($laporanGagalProduksi->sum('jumlah_berhasil')) }}</td>
                                        <td class="text-center fw-bold text-danger">{{ number_format($laporanGagalProduksi->sum('jumlah_gagal')) }}</td>
                                        <td class="text-center fw-bold">
                                            {{ number_format(($laporanGagalProduksi->sum('jumlah_gagal') / $laporanGagalProduksi->sum('jumlahdiproduksi')) * 100, 1) }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-fluid text-center py-3">
            <small class="text-muted">© 2024 MyCrafts</small>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#failureTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy me-2"></i>Copy',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv me-2"></i>CSV',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel me-2"></i>Excel',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-2"></i>PDF',
                className: 'btn btn-secondary btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print me-2"></i>Print',
                className: 'btn btn-secondary btn-sm'
            }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)"
        }
    });
});
</script>
@endsection
