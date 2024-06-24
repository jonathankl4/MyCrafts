@extends('template.BackupMasterDesain')

@section('title', 'Dashboard')

@section('style')
<style>
    .dataTables_wrapper .dataTables_filter {
  position: absolute;
  top: 130px;
  right: 40px;


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

            <form action="{{url('seller/addMebel')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama Mebel</label>
                    <input type="text" class="form-control" id="namaMebel" name="namaMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('namaMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Ukuran</label>
                    <input type="text" class="form-control" id="ukuranMebel" name="ukuranMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('ukuranMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >satuan</label>
                    <input type="text" class="form-control" id="satuanMebel" name="satuanMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('satuanMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >jumlah</label>
                    <input type="text" class="form-control" id="jumlahMebel" name="jumlahMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('jumlahMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >jenis</label>
                    <input type="text" class="form-control" id="jenisMebel" name="jenisMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('jenisMebel')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >harga</label>
                    <input type="text" class="form-control" id="hargaMebel" name="hargaMebel" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('hargaMebel')}}</span>
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


@endsection


