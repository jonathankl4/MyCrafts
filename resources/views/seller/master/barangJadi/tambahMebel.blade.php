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

        <div class="card" style="padding: 15px; ">

            <form action="{{url('seller/addMebel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Mebel </label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaMebel" name="namaMebel" placeholder="nama mebel" value="{{old('namaMebel')}}" />
                        <span style="color: red;">{{ $errors->first('namaMebel')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Ukuran</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Ukuran" value="{{old('ukuran')}}" />
                        <span style="color: red;">{{ $errors->first('ukuran')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Bahan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="bahan" name="bahan" placeholder="Tipe Mebel" value="{{old('bahan')}}" />
                        <span style="color: red;">{{ $errors->first('bahan')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class=" col-md-2 col-form-label" style="font-size: 16px" >Harga</label>
                    <div class="col-md-10">

                        <input type="number" class="form-control" id="hargaMebel" name="hargaMebel" placeholder="Harga" value="{{old('hargaMebel')}}" />
                        <span style="color: red;">{{ $errors->first('hargaMebel')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-md-2" style="font-size: 16px">Stok</label>
                    <div class="col-md-10">

                        <input type="number" class="form-control" id="jumlahMebel" name="jumlahMebel" placeholder="Stok Mebel" value="{{old('jumlahMebel')}}" />
                        <span style="color: red;">{{ $errors->first('jumlahMebel')}}</span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class=" col-md-2 col-form-label" style="font-size: 16px" >Keterangan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="keteranganMebel" name="keteranganMebel" placeholder="Keterangan" value="{{old('keteranganMebel')}}" />
                        <span style="color: red;">{{ $errors->first('keteranganMebel')}}</span>
                    </div>
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


