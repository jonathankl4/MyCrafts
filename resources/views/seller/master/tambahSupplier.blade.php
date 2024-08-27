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
        <h2 class="fw-bold  mb-4">Tambah Supplier</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addSupplier')}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">Nama Supplier</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" placeholder="Nama supplier" value="{{old('namaSupplier')}}" />
                        <span style="color: red;">{{ $errors->first('namaSupplier')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">No Telp</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="noTelpSupplier" name="noTelpSupplier" placeholder="Nomor Telepon" value="{{old('noTelpSupplier')}}" />
                        <span style="color: red;">{{ $errors->first('noTelpSupplier')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Alamat (opsional)</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="alamatSupplier" name="alamatSupplier" placeholder="Alamat" value="{{old('alamatSupplier')}}" />
                    </div>

                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">Keterangan (opsional)</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="ketSupplier" name="ketSupplier" placeholder="keterangan" value="{{old('ketSupplier')}}" />
                    </div>

                </div>
                <div style="float: right">
                    <a href="{{url('/seller/master/supplier')}}" class="btn btn-outline-dark">Kembali</a>
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


