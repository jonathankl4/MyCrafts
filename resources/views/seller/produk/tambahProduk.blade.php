@extends('template.BackupMasterDesain')

@section('title', 'Dashboard')

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
        <h2 class="fw-bold  mb-4">Tambah Produk</h2>
        <form action="{{url('seller/addProduk')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Informasi Produk</h3>

                    <div class="mb-3">
                        <label class="form-label" >Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="nama Produk" />
                        <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >tipe Produk</label>
                        <input type="text" class="form-control" id="tipeProduk" name="tipeProduk" placeholder="Tipe Produk" />
                        <span style="color: red;">{{ $errors->first('ukuranProduk')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Harga</label>
                        <input type="text" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Harga" />
                        <span style="color: red;">{{ $errors->first('satuanProduk')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >stok dijual</label>
                        <input type="text" class="form-control" id="jumlahProduk" name="jumlahProduk" placeholder="Jumlah Produk" />
                        <span style="color: red;">{{ $errors->first('jumlahProduk')}}</span>
                    </div>


            </div>
            <br>
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Berat Produk</h3>

                <div class="mb-3">
                    <label class="form-label" >Berat</label>
                    <input type="text" class="form-control" id="beratProduk" name="beratProduk" placeholder="Berat Produk" />
                        <span style="color: red;">{{ $errors->first('beratProduk')}}</span>
                </div>

                <div class="mb-3">
                    <label class="form-label" >Ukuran</label>

                    <div>
                        <select name="satuanProduk" id="" class="theSelect" style="height: 50px;width: 50%" >
                            <option value="" disabled selected hidden>Satuan Ukuran</option>
                            @for ($i=0; $i<count($satuan); $i++)

                            <option value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>
                            @endfor

                        </select>

                        <input type="text" class="form-control" id="ukuranPanjang" name="ukuranPanjang" placeholder="Panjang" />
                        <span style="color: red;">{{ $errors->first('ukuranPanjang')}}</span>
                        <input type="text" class="form-control" id="ukuranLebar" name="ukuranLebar" placeholder="Lebar"  />
                        <span style="color: red;">{{ $errors->first('ukuranLebar')}}</span>
                        <input type="text" class="form-control" id="ukuranTinggi" name="ukuranTinggi" placeholder="Tinggi"  />
                        <span style="color: red;">{{ $errors->first('ukuranTinggi')}}</span>

                    </div>
                </div>


            </div>
            <br>
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Detail Produk</h3>

                <div class="mb-3">
                    <label class="form-label" >Keterangan</label>
                    <input type="text" class="form-control" id="keteranganProduk" name="keteranganProduk" placeholder="Keterangan" />
                    <span style="color: red;">{{ $errors->first('hargaProduk')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >foto Utama</label>
                    <input type="file" class="form-control" id="fotoProduk1" name="fotoProduk1"  />
                    <label class="form-label" >foto 2</label>
                    <input type="file" class="form-control" id="fotoProduk2" name="fotoProduk2"  />
                    <label class="form-label" >foto 3</label>
                    <input type="file" class="form-control" id="fotoProduk3" name="fotoProduk3"  />
                    <label class="form-label" >foto 4</label>
                    <input type="file" class="form-control" id="fotoProduk4" name="fotoProduk4"  />

                </div>

            </div>
            <br>
            <div style="float: right">
                <a href="{{url('/seller/master/Produk')}}" class="btn btn-outline-dark">Kembali</a>
                <button class="btn btn-primary">Tambah</button>
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
</script>


@endsection


