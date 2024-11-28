@extends('template.MasterDesain')

@section('title', 'Penerimaan Bahan')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <h1>Tambah Pengiriman Baru</h1>

    <div class="card" style="padding: 10px">

        <form action="{{ route('pengiriman.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mebel</label>
                        <select name="id_mebel" class="form-select select2" required>
                            @foreach($mebels as $mebel)
                                <option value="{{ $mebel->id }}">{{ $mebel->nama_mebel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required min="1">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Pengiriman</label>
                        <input type="datetime-local" name="tanggal_pengiriman" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Biaya Pengiriman</label>
                        <input type="number" name="biaya_pengiriman" class="form-control" required min="0">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Nama Penerima</label>
               <input type="text" name="nama_penerima" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jasa Pengiriman</label>
                        <input type="text" name="jasa_pengiriman" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor Resi</label>
                        <input type="text" name="nomor_resi" class="form-control">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready( function () {
        $('#tPenerimaanBahan').DataTable();
        $('.select2').select2();
    });




  </script>

@endsection


