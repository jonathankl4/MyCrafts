@extends('template.BackupMasterDesain')

@section('title', 'Edit Produk Non-Custom')

@section('style')
<style>

    .dataTables_wrapper .dataTables_filter {
  position: absolute;
  top: 130px;
  right: 40px;

}

#image-label{
    position: relative;
    width: 200px;
    height: 200px;
    background: #fff;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    display:flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 1px 7px rgba(105, 110, 232, 0.54);
    border-radius: 10px;
    flex-direction: column;
    gap: 15px;
    user-select: none;
    cursor: pointer;
    color: #207ed1;
    transition: all 1s;
}

#image-label:hover{
    color: #18ac1c;
}







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
        <h2 class="fw-bold  mb-4">Edit Produk</h2>
        <form action="{{url('seller/editProduk/'.$produk->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Informasi Produk</h3>

                    <div class="mb-3 row ">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk"  value="{{$produk->nama_produk}}"/>
                            <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Ukuran</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="ukuran" name="ukuran"
                                placeholder="contoh: 10x10x10 (cm)"  value="{{$produk->ukuran}}" />
                            <span style="color: red;">{{ $errors->first('ukuran') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Bahan</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="bahan" name="bahan"
                                placeholder="Jenis Kayu yang dipakai"  value="{{$produk->bahan}}"/>
                            <span style="color: red;">{{ $errors->first('bahan') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"  style="font-size: 16px">Harga</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Harga"  value="{{$produk->harga_produk}}" />
                            <span style="color: red;">{{ $errors->first('hargaProduk')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"  style="font-size: 16px">stok dijual</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="jumlahProduk" name="jumlahProduk" placeholder="Jumlah Produk"  value="{{$produk->jumlah_produk}}" />
                            <span style="color: red;">{{ $errors->first('jumlahProduk')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Deskripsi Produk</label>
                        <div class="col-md-10">

                            <textarea name="keteranganProduk" id="keteranganProduk" cols="30" rows="5">{{$produk->keterangan_produk}}</textarea>
                        </div>

                            <span style="color: red;">{{ $errors->first('keteranganProduk') }}</span>

                    </div>


            </div>
            <br>

            <br>
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Detail Produk</h3>


                <div class="mb-3 ">
                    <label class="form-label" style="font-size: 16px" >foto Utama</label>
                    <div class="col-md-10">

                        <img src="{{url("/storage/imgProduk/".$produk->foto_produk1)}}" alt="" style="width:100px; height:100px" >

                        <input type="file" class="form-control" id="fotoUtama" name="fotoUtama"/>

                        <span style="color: red;">{{ $errors->first('fotoUtama')}}</span>

                    </div>


                </div>
                <div class="mb-3 ">
                    <label class="form-label" style="font-size: 16px">foto 2</label>
                    <div class="col-md-10">
                        @if ($produk->foto_produk2 != null)

                        <img src="{{url("/storage/imgProduk/".$produk->foto_produk2)}}" alt="" style="width:100px; height:100px" >

                        @else
                        <p>foto kosong</p>
                        @endif
                        <input type="file" class="form-control" id="fotoProduk2" name="fotoProduk2"  />
                    </div>

                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 16px">foto 3</label>
                    <div class="col-md-10">
                        @if ($produk->foto_produk3 != null)
                        <img src="{{url("/storage/imgProduk/".$produk->foto_produk3)}}" alt="" style="width:100px; height:100px" >

                        @else
                        <p>foto kosong</p>
                        @endif
                        <input type="file" class="form-control" id="fotoProduk3" name="fotoProduk3"  />
                    </div>

                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 16px" >foto 4</label>

                    <div class="col-md-10">
                        @if ($produk->foto_produk4 != null)

                        <img src="{{url("/storage/imgProduk/".$produk->foto_produk4)}}" alt="" style="width:100px; height:100px" >
                        @else
                        <p>foto kosong</p>

                        @endif
                        <input type="file" class="form-control" id="fotoProduk4" name="fotoProduk4"  />
                    </div>
                </div>

            </div>
            <br>
            <div style="float: right">
                <a href="{{url('/seller/produk/daftarProduk')}}" class="btn btn-outline-dark">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>


    </form>







    </div>























    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">

    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
  </div>

  <script>
    $(".theSelect").select2();


    $('#satuanProduk').on('change', function() {
            let selectedValue = $(this).val();
            document.getElementById('labelPanjang').textContent =
            selectedValue;
            document.getElementById('labelLebar').textContent =
            selectedValue;
            document.getElementById('labelTinggi').textContent =
            selectedValue;  // Gunakan nilai yang dipilih dari Select2
        });
</script>


@endsection


