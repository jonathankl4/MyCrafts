@extends('template.BackupMasterDesain')

@section('title', 'Tambah Detail BOM')

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
        <h2 class="fw-bold  mb-4">Tambah Detail BOM (<span style="background-color: yellow">{{$bom->nama_product}}</span>) </h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addDetailBom/'.$bom->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama bahan</label>
                    <input type="text" class="form-control" id="namaBahan" name="namaBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('namaBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Deskripsi</label>
                    <input type="text" class="form-control" id="n" name="deskripsi" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('deskripsi')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('jumlah')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('ukuran')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Harga bahan</label>
                    <input type="text" class="form-control" id="hargaBahan" name="hargaBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('hargaBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Subtotal</label>
                    <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('subtotal')}}</span>
                </div>

                <div style="float: right">
                    <a href="{{url('/seller/pDetailBom/'.$bom->id)}}" class="btn btn-outline-dark">Kembali</a>
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


