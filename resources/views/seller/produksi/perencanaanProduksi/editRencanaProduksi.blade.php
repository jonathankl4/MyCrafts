@extends('template.BackupMasterDesain')

@section('title', 'Tambah Produksi')

@section('style')
<style>






</style>
@endsection

@section('sidebar')



@endsection

@section('navbar')
@include('seller.template.navbar')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 1cm ">
        <h2 class="fw-bold  mb-4">Tambah Perencanaan Produksi</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/editProduksi/'.$produksi->id)}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">Tanggal Produksi</label>
                    <div class="col-md-10">

                        <input type="date" class="form-control" id="tglProduksi" name="tglProduksi" placeholder="Nama supplier" value="{{$produksi->tgl_produksi}}" />
                        <span style="color: red;">{{ $errors->first('tglProduksi')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk yang diproduksi" value="{{$produksi->nama_produk}}" />
                        <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah Produksi</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="jumlahProduksi" name="jumlahProduksi" placeholder="jumlah yang diproduksi" value="{{$produksi->jumlahdiproduksi}}" />
                        <span style="color: red;">{{ $errors->first('jumlahProduksi')}}</span>
                    </div>

                </div>

                <div style="float: right">
                    <a href="{{url('/seller/produksi/perencanaanProduksi')}}" class="btn btn-outline-dark">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>


            </form>


        </div>

    </div>



    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
  </div>


@endsection


