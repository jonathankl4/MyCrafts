<!-- resources/views/penerimaan-barang/detail.blade.php -->
@extends('template.MasterDesain')

@section('title', 'Detail Penerimaan Bahan')

@section('sidebar')
@include('seller.template.sidebar')
@endsection

@section('navbar')
@include('seller.template.navbar')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Detail Penerimaan Bahan</h5>
                <a href="{{ route('penerimaan-barang.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Informasi Penerimaan</h6>
                        <table class="table">
                            <tr>
                                <th>Tanggal Penerimaan</th>
                                <td>{{ $penerimaan->tanggal_penerimaan }}</td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>{{ $penerimaan->supplier->nama_sup }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $penerimaan->status_penerimaan }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $penerimaan->catatan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="card-title">Detail Bahan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penerimaan->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->barang->nama_bahan }}</td>
                                        <td>{{ $detail->jumlah }}{{$detail->barang->satuan_jumlah}}</td>
                                        <td>{{ $detail->keterangan ?? '-' }}</td>
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
</div>
@endsection
