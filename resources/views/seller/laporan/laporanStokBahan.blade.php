@extends('template.LaporanTemplate')

@section('title', 'Laporan Stok Bahan')

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

    .stock-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .stock-warning {
        background-color: #fff3cd;
        color: #856404;
    }

    .stock-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .stock-success {
        background-color: #d4edda;
        color: #155724;
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
                    <i class="fas fa-boxes me-2"></i>Laporan Stok Bahan
                </h2>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-layer-group me-2"></i>Total Jenis Bahan
                                </h5>
                                <h3 class="mb-0">{{ count($stokBahan) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-coins me-2"></i>Total Nilai Stok
                                </h5>
                                <h3 class="mb-0">Rp {{ number_format($stokBahan->sum(function($bahan) {
                                    return $bahan->jumlah_bahan * $bahan->harga_bahan;
                                }), 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-warehouse me-2"></i>Rata-rata Stok
                                </h5>
                                <h3 class="mb-0">{{ number_format($stokBahan->avg('jumlah_bahan'), 1) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="stockTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Bahan</th>
                                        <th class="text-center">Jumlah Stok</th>
                                        <th>Satuan</th>
                                        <th class="text-end">Harga Satuan</th>
                                        <th class="text-end">Total Nilai</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stokBahan as $index => $bahan)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $bahan->nama_bahan }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $bahan->jumlah_bahan <= 5 ? 'danger' : ($bahan->jumlah_bahan <= 10 ? 'warning' : 'success') }}">
                                                    {{ $bahan->jumlah_bahan }}
                                                </span>
                                            </td>
                                            <td>{{ $bahan->satuan_bahan }}</td>
                                            <td class="text-end">Rp {{ number_format($bahan->harga_bahan, 0, ',', '.') }}</td>
                                            <td class="text-end">Rp {{ number_format($bahan->jumlah_bahan * $bahan->harga_bahan, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if($bahan->jumlah_bahan <= 5)
                                                    <span class="badge bg-danger">Stok Kritis</span>
                                                @elseif($bahan->jumlah_bahan <= 10)
                                                    <span class="badge bg-warning text-dark">Stok Menipis</span>
                                                @else
                                                    <span class="badge bg-success">Stok Aman</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total:</td>
                                        <td class="text-end fw-bold">-</td>
                                        <td class="text-end fw-bold">
                                            Rp {{ number_format($stokBahan->sum(function($bahan) {
                                                return $bahan->jumlah_bahan * $bahan->harga_bahan;
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
    $('#stockTable').DataTable({
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
