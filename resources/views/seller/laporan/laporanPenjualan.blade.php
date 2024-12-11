@extends('template.LaporanTemplate')

@section('title', 'Laporan Penjualan')

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
                    <i class="fas fa-chart-line me-2"></i>Laporan Penjualan
                </h2>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body" >
                                <h5 class="card-title" style="color: black">
                                    <i class="fas fa-shopping-cart me-2"></i>Total Transaksi
                                </h5>
                                <h3 class="mb-0" style="color: black">{{ count($laporanPenjualan) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title"style="color: black">
                                    <i class="fas fa-money-bill-wave me-2"></i>Total Pendapatan
                                </h5>
                                <h3 class="mb-0"style="color: black">Rp {{ number_format($laporanPenjualan->sum(function($item) {
                                    return $item->harga ?? $item->harga_redesain;
                                }), 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black">
                                    <i class="fas fa-box me-2"></i>Total Produk Terjual
                                </h5>
                                <h3 class="mb-0" style="color: black">{{ $laporanPenjualan->sum('jumlah') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black">
                                    <i class="fas fa-percentage me-2"></i>Rasio Sukses
                                </h5>
                                @if (count($laporanPenjualan) > 0)

                                <h3 class="mb-0" style="color: black">{{
                                    number_format(
                                        ($laporanPenjualan->where('status', 7)->count() +
                                         $laporanPenjualan->where('status', 12)->count()) /
                                        count($laporanPenjualan) * 100,
                                    1)
                                }}%</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section mb-4">
                    <form method="GET" action="{{ route('laporan-penjualan.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Tanggal Awal:
                            </label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Tanggal Akhir:
                            </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-3">
                            <label for="tipe_trans" class="form-label">
                                <i class="fas fa-filter me-1"></i>Tipe Transaksi:
                            </label>
                            <select name="tipe_trans" id="tipe_trans" class="form-select">
                                <option value="">Semua</option>
                                <option value="Custom" {{ $tipeTrans == 'Custom' ? 'selected' : '' }}>Custom</option>
                                <option value="Non-Custom" {{ $tipeTrans == 'Non-Custom' ? 'selected' : '' }}>Non-Custom</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
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
                            <table class="table table-hover table-striped" id="salesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Produk</th>
                                        <th>Tipe Transaksi</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanPenjualan as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_transaksi)->format('d M Y') }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>
                                            <span class="badge {{ $item->tipe_trans == 'Custom' ? 'bg-info' : 'bg-secondary' }}">
                                                {{ $item->tipe_trans }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                        <td class="text-end">Rp {{ number_format($item->harga ?? $item->harga_redesain, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @php
                                                $statusBadge = match($item->status) {
                                                    7 => 'bg-success',
                                                    8 => 'bg-danger',
                                                    9 => 'bg-warning',
                                                    10 => 'bg-danger',
                                                    12 => 'bg-success',
                                                    default => 'bg-secondary'
                                                };

                                                $statusText = match($item->status) {
                                                    7 => 'Pesanan Selesai',
                                                    8 => 'Pesanan Dibatalkan',
                                                    9 => 'Dibatalkan Buyer',
                                                    10 => 'Pembayaran Dibatalkan',
                                                    12 => 'Retur Ditolak, Selesai',
                                                    default => 'Status Tidak Dikenal'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusBadge }}">{{ $statusText }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">{{ $laporanPenjualan->sum('jumlah') }}</td>
                                        <td class="text-end fw-bold">
                                            Rp {{ number_format($laporanPenjualan->sum(function($item) {
                                                return $item->harga ?? $item->harga_redesain;
                                            }), 0, ',', '.') }}
                                        </td>
                                        <td></td>
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
    $('#salesTable').DataTable({
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
