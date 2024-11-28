@extends('template.MasterDesain')

@section('title', 'Penerimaan Bahan')

@section('style')
<style>






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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Riwayat Penerimaan Bahan</h5>
                <a href="{{ route('penerimaan-barang.create') }}" class="btn btn-primary">
                    Tambah Penerimaan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tPenerimaanBahan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penerimaans as $penerimaan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penerimaan->tanggal_penerimaan }}</td>
                                <td>{{ $penerimaan->supplier->nama_sup }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $penerimaan->status_penerimaan }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('penerimaan-barang.show', $penerimaan->id) }}"
                                       class="btn btn-info btn-sm">
                                        Detail
                                    </a>
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
@endsection


@section('script')
<script>
    $(document).ready( function () {
        $('#tPenerimaanBahan').DataTable();
    });




  </script>

@endsection


