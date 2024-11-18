@extends('template.LaporanTemplate')

@section('title', 'Laporan Mutasi')

@section('style')
<style>
    .date-filter-form {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

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

    .badge-mutasi {
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
                    <i class="fas fa-exchange-alt me-2"></i>Laporan Mutasi
                </h2>

                <!-- Filter Card -->
                <div class="card mb-4">
                    <div class="card-body date-filter-form">
                        <form method="GET" action="{{ route('laporan-mutasi.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label for="start_date" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>Tanggal Awal
                                </label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $startDate }}">
                            </div>
                            <div class="col-md-5">
                                <label for="end_date" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i>Tanggal Akhir
                                </label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $endDate }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="mutationTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Stok Masuk</th>
                                        <th class="text-center">Stok Keluar</th>
                                        <th class="text-center">Jenis Mutasi</th>
                                        <th>Jenis Barang</th>

                                        <th class="text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanMutasi as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td class="text-center">
                                                @if($item->stok_masuk > 0)
                                                    <span class="badge bg-success">{{ $item->stok_masuk }}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->stok_keluar > 0)
                                                    <span class="badge bg-danger">{{ $item->stok_keluar }}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-mutasi {{ $item->jenis_mutasi == 'mbukasuk' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->jenis_mutasi }}
                                                </span>
                                            </td>
                                            <td>{{ $item->jenis_barang }}</td>

                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">
                                            <span class="badge bg-success">
                                                {{ $laporanMutasi->sum('stok_masuk') }}
                                            </span>
                                        </td>
                                        <td class="text-center fw-bold">
                                            <span class="badge bg-danger">
                                                {{ $laporanMutasi->sum('stok_keluar') }}
                                            </span>
                                        </td>
                                        <td colspan="5"></td>
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
    $('#mutationTable').DataTable({
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
