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
        <h2 class="fw-bold  mb-4">Tambah Mebel</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addMebel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama Mebel</label>
                    <input type="text" class="form-control" id="namaMebel" name="namaMebel" placeholder="nama mebel" />
                    <span style="color: red;">{{ $errors->first('namaMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >tipe mebel</label>
                    <input type="text" class="form-control" id="tipeMebel" name="tipeMebel" placeholder="Tipe Mebel" />
                    <span style="color: red;">{{ $errors->first('ukuranMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Harga</label>
                    <input type="text" class="form-control" id="hargaMebel" name="hargaMebel" placeholder="Harga" />
                    <span style="color: red;">{{ $errors->first('satuanMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >jumlah</label>
                    <input type="text" class="form-control" id="jumlahMebel" name="jumlahMebel" placeholder="Jumlah Mebel" />
                    <span style="color: red;">{{ $errors->first('jumlahMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Ukuran</label>

                    <div>
                        <select name="satuanMebel" id="" class="theSelect" style="height: 50px;width: 50%" >
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
                <div class="mb-3">
                    <label class="form-label" >Keterangan</label>
                    <input type="text" class="form-control" id="keteranganMebel" name="keteranganMebel" placeholder="Keterangan" />
                    <span style="color: red;">{{ $errors->first('hargaMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >foto Utama</label>
                    <input type="file" class="form-control" id="fotoMebel1" name="fotoMebel1"  />
                    <label class="form-label" >foto 2</label>
                    <input type="file" class="form-control" id="fotoMebel2" name="fotoMebel2"  />
                    <label class="form-label" >foto 3</label>
                    <input type="file" class="form-control" id="fotoMebel3" name="fotoMebel3"  />
                    <label class="form-label" >foto 4</label>
                    <input type="file" class="form-control" id="fotoMebel4" name="fotoMebel4"  />

                </div>

                <div style="float: right">
                    <a href="{{url('/seller/master/mebel')}}" class="btn btn-outline-dark">Kembali</a>
                    <button class="btn btn-primary">Tambah</button>
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

  <script>
    $(".theSelect").select2();
</script>


@endsection


