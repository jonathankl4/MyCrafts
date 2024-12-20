@extends('template.LaporanTemplate')

@section('title', 'Laporan Retur')

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

    .status-diterima { color: green; }
    .status-ditolak { color: red; }
    .status-menunggu { color: orange; }
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
                <h2 class="page-header fw-bold py-3">Laporan Retur</h2>

                <div class="card mb-4">
                    <div class="card-body date-filter-form">
                        <form method="GET" action="{{ route('laporan-retur.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $startDate }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $endDate }}">
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status Retur</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="0" {{ $status == '0' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="1" {{ $status == '1' ? 'selected' : '' }}>Diterima</option>
                                    <option value="2" {{ $status == '2' ? 'selected' : '' }}>Ditolak</option>
                                </select>
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
                            <table class="table table-hover table-striped" id="returTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Alasan Retur</th>
                                        <th>Tanggal Retur</th>
                                        <th>Tanggal Retur Sampai</th>
                                        <th>Status</th>
                                        <th>Alasan Ditolak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanRetur as $index => $retur)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $retur->nama_produk }}</td>
                                            <td>{{ $retur->jumlah }}</td>
                                            <td>{{ $retur->alasan_retur }}</td>
                                            <td>{{ \Carbon\Carbon::parse($retur->tgl_retur)->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($retur->tgl_retur_sampai)
                                                    {{ \Carbon\Carbon::parse($retur->tgl_retur_sampai)->format('d/m/Y H:i') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="{{
                                                    $retur->status == 1 ? 'status-diterima' :
                                                    ($retur->status == 2 ? 'status-menunggu' : 'status-ditolak')
                                                }}">
                                                    {{
                                                        $retur->status == 1 ? 'Diterima' :
                                                        ($retur->status == 2 ? 'Menunggu' : 'Ditolak')
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($retur->status == 3 && $retur->alasan_retur_ditolak)
                                                    {{ $retur->alasan_retur_ditolak }}
                                                @else
                                                    -
                                                @endif
                                            </td>
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
    $('#returTable').DataTable({
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
