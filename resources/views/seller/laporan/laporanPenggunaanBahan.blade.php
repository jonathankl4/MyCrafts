@extends('template.LaporanTemplate')

@section('title', 'Laporan Penggunaan Bahan')

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

    .status-belum-mulai { color: orange; }
    .status-sedang-berlangsung { color: blue; }
    .status-selesai { color: green; }
    .status-dibatalkan { color: red; }
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
    <div class="container-fluid px-4 py-3">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header fw-bold py-3">Laporan Penggunaan Bahan</h2>

                <div class="card mb-4">
                    <div class="card-body date-filter-form">
                        <form method="GET" action="{{ route('laporan-penggunaan-bahan.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $startDate }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $endDate }}">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filter Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="penggunaanBahanTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kode Produksi</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal Produksi</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah Bahan Digunakan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanPenggunaanBahan as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->rencanaProduksi->kode_produksi ?? '-' }}</td>
                                            <td>{{ $item->rencanaProduksi->nama_produk ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->rencanaProduksi->tgl_produksi_mulai)->format('d/m/Y') }}</td>
                                            <td>{{ $item->nama_bahan }}</td>
                                            <td>{{ $item->jumlah_penggunaan }} {{$item->bahan->satuan_jumlah}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="content-footer footer bg-footer-theme">
        <div class="container-fluid text-center py-3">
            <small class="text-muted">© 2024 MyCrafts</small>
        </div>
    </footer>

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#penggunaanBahanTable').DataTable({
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
