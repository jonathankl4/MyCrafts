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
        <h2 class="fw-bold  mb-4">Edit Bill of Material</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/editBom/'.$bom->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="-" value="{{$bom->nama_product}}" />
                    <span style="color: red;">{{ $errors->first('namaProduk')}}</span>
                </div>

                <div style="float: right">
                    <a href="{{url('/seller/produksi/bom')}}" class="btn btn-outline-dark">Kembali</a>
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
  <script>
    $(".theSelect").select2();
</script>

@endsection


