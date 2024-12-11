@extends('template.LaporanTemplate')

@section('title', 'Laporan Produksi')

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

    .status-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .filter-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .success-rate {
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .success-high {
        color: #155724;
        background-color: #d4edda;
    }

    .success-medium {
        color: #856404;
        background-color: #fff3cd;
    }

    .success-low {
        color: #721c24;
        background-color: #f8d7da;
    }

    .duration-badge {
        background-color: #e9ecef;
        color: #495057;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.875rem;
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
                    <i class="fas fa-industry me-2"></i>Laporan Produksi
                </h2>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-tasks me-2"></i>Total Produksi
                                </h5>
                                <h3 class="mb-0">{{ $laporanProduksi->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-check-circle me-2"></i>Total Berhasil
                                </h5>
                                <h3 class="mb-0">{{ $laporanProduksi->sum('jumlah_berhasil') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-times-circle me-2"></i>Total Gagal
                                </h5>
                                <h3 class="mb-0">{{ $laporanProduksi->sum('jumlah_gagal') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-percentage me-2"></i>Tingkat Keberhasilan
                                </h5>
                                <h3 class="mb-0">
                                    @if (count($laporanProduksi) > 0)
                                    {{ number_format(($laporanProduksi->sum('jumlah_berhasil') / $laporanProduksi->sum('jumlahdiproduksi')) * 100, 1) }}%
                                    @else
                                    0
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section mb-4">
                    <form method="GET" action="{{ route('laporan-produksi.index') }}" class="row g-3">
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
                            <table class="table table-hover table-striped" id="productionTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Target Produksi</th>
                                        <th class="text-center">Berhasil</th>
                                        <th class="text-center">Gagal</th>
                                        <th class="text-center">Tingkat Keberhasilan</th>
                                        <th class="text-center">Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanProduksi as $item)
                                    @php
                                        $successRate = ($item->jumlah_berhasil / $item->jumlahdiproduksi) * 100;
                                        $successClass = $successRate >= 90 ? 'success-high' :
                                                      ($successRate >= 75 ? 'success-medium' : 'success-low');
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_produksi_mulai)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_produksi_selesai)->format('d M Y') }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td class="text-center">{{ number_format($item->jumlahdiproduksi) }}</td>
                                        <td class="text-center text-success">{{ number_format($item->jumlah_berhasil) }}</td>
                                        <td class="text-center text-danger">{{ number_format($item->jumlah_gagal) }}</td>
                                        <td class="text-center">
                                            <span class="status-badge {{ $successClass }}">
                                                {{ number_format($successRate, 1) }}%
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="duration-badge">
                                                <i class="far fa-clock me-1"></i>{{ $item->durasi + 1 }} Hari
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">{{ number_format($laporanProduksi->sum('jumlahdiproduksi')) }}</td>
                                        <td class="text-center fw-bold text-success">{{ number_format($laporanProduksi->sum('jumlah_berhasil')) }}</td>
                                        <td class="text-center fw-bold text-danger">{{ number_format($laporanProduksi->sum('jumlah_gagal')) }}</td>
                                        @if (count($laporanProduksi) > 0)
                                        <td class="text-center fw-bold">{{ number_format(($laporanProduksi->sum('jumlah_berhasil') / $laporanProduksi->sum('jumlahdiproduksi')) * 100, 1) }}%</td>
                                        @else
                                        0
                                        @endif
                                        <td class="text-center fw-bold">{{ $laporanProduksi->sum('durasi') + $laporanProduksi->count() }} Hari</td>
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
    $('#productionTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
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
