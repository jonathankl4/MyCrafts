@extends('template.BackupMasterDesain')

@section('title', 'Input Hasil Produksi')

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
        <h2 class="fw-bold  mb-4">Input Hasil Produksi</h2>
        <a href="{{url('/seller/riwayatInputHasilProduksi')}}" class="btn btn-primary">Riwayat Input Hasil Produksi</a>
        <br><br>
        <div class="card" style="padding: 15px">

            <form action="{{url('seller/simpanHasilProduksi')}}" method="POST">
                @csrf

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">Pilih Produksi yang sudah selesai</label>
                    <div class="col-md-10">
                        <select name="listProduksi" id="listProduksi" class="theSelect form-select" style="height: 50px;" onchange=ambildata() >


                            @if (count($listProduksi) > 0)
                            @for ($i=0; $i<count($listProduksi); $i++)

                            <option value="" disabled selected>Pilih</option>
                            <option value="{{$listProduksi[$i]->id}}">{{$listProduksi[$i]->id}}-{{$listProduksi[$i]->nama_produk}}-{{$listProduksi[$i]->jumlahdiproduksi}}</option>
                            @endfor
                            @elseif (count($listProduksi) < 1)
                            <option value="" disabled selected hidden>Belum ada produksi yang selesai</option>
                            @endif




                        </select>


                        <span style="color: red;">{{ $errors->first('listProduksi')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk yang diproduksi" value="" readonly/>
                        <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Durasi Produksi</label>
                    <div class="col-md-10">

                        <div class="input-group">

                            <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Durasi lama Produksi" value="{{old('durasi')}}" readonly aria-describedby="desdurasi" />
                            <span class="input-group-text" id="desdurasi">Hari</span>
                        </div>
                        <span style="color: red;">{{ $errors->first('durasi')}}</span>
                    </div>

                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah Produksi</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="jumlahProduksi" name="jumlahProduksi" placeholder="jumlah yang diproduksi" value="{{old('jumlahProduksi')}}" readonly/>
                        <span style="color: red;">{{ $errors->first('jumlahProduksi')}}</span>
                    </div>

                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah Produk Berhasil</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="jumlahBerhasil" name="jumlahBerhasil" placeholder="jumlah yang berhasil diproduksi" value="{{old('jumlahBerhasil')}}" />
                        <span style="color: red;">{{ $errors->first('jumlahBerhasil')}}</span>
                    </div>

                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah Produk Gagal</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="jumlahGagal" name="jumlahGagal" placeholder="jumlah yang gagal diproduksi" value="{{old('jumlahGagal')}}" />
                        <span style="color: red;">{{ $errors->first('jumlahGagal')}}</span>
                    </div>

                </div>


                <div style="float: right">
                    <a href="{{url('/seller')}}" class="btn btn-outline-dark">Kembali</a>
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

@section('script')

<script language='javascript'>

    function ambildata(){

        let anjay = $('#listProduksi').val();



        $.ajax({
            type: 'get',
            url : '{{url('seller/getRP')}}',
            data : {'id': anjay},
            success: function(data){

                console.log(data)
                $('#namaProduk').val(data['nama_produk']);
                $('#jumlahProduksi').val(data['jumlahdiproduksi']);
                $('#durasi').val(data['waktu_produksi']);



            }
        })
    }
</script>
@endsection


