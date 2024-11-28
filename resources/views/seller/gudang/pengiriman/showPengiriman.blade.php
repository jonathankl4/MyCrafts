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
<div class="container">
    <h1>Detail Pengiriman</h1>

    <div class="card">
        <div class="card-body">
            <h5>Informasi Pengiriman</h5>
            <table class="table">

                <tr>
                    <th>Mebel</th>
                    <td>{{ $pengiriman->mebel->nama_mebel }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $pengiriman->jumlah }}</td>
                </tr>
                <tr>
                    <th>Penerima</th>
                    <td>{{ $pengiriman->nama_penerima }}</td>
                </tr>

                <tr>
                    <th>Tanggal Pengiriman</th>
                    <td>{{ $pengiriman->tanggal_pengiriman }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pengiriman->alamat }}</td>
                </tr>
                <tr>
                    <th>Jasa Pengiriman</th>
                    <td>{{ $pengiriman->jasa_pengiriman ?? 'Tidak Ditentukan' }}</td>
                </tr>
                <tr>
                    <th>Nomor Resi</th>
                    <td>{{ $pengiriman->nomor_resi ?? 'Belum Ada' }}</td>
                </tr>
                <tr>
                    <th>Biaya Pengiriman</th>
                    <td>Rp. {{ number_format($pengiriman->biaya_pengiriman, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
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


