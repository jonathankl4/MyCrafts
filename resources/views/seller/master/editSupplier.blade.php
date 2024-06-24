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
        <h2 class="fw-bold  mb-4">Edit Supplier</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/editSupplier/'.$sup->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama Supplier</label>
                    <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" placeholder="" value="{{$sup->nama_sup}}" />
                    <span style="color: red;">{{ $errors->first('namaSupplier')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >No Telp</label>
                    <input type="text" class="form-control" id="noTelpSupplier" name="noTelpSupplier" placeholder="" value="{{$sup->notelp_sup}}" />
                    <span style="color: red;">{{ $errors->first('noTelpSupplier')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Alamat (opsional)</label>
                    <input type="text" class="form-control" id="alamatSupplier" name="alamatSupplier" placeholder="" value="{{$sup->alamat_sup}}" />

                </div>
                <div class="mb-3">
                    <label class="form-label" >Keterangan (opsional)</label>
                    <input type="text" class="form-control" id="ketSupplier" name="ketSupplier" placeholder="contoh: gram, kg, dll" value="{{$sup->keterangan_sup}}" />

                </div>
                <div style="float: right">
                    <a href="{{url('/seller/master/supplier')}}" class="btn btn-outline-dark">Batal</a>
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


