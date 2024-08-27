@extends('template.BackupMasterDesain')

@section('title', 'Tambah Add-On')

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
        <h2 class="fw-bold  mb-4">Tambah Add On</h2>
        <form action="{{url('seller/addAddOn')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Informasi Add On</h3>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px" >Nama Add On</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama Add-On"  value="{{old('nama')}}"/>
                            <span style="color: red;">{{ $errors->first('nama')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">tipe</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Tipe Add-On" value="{{old('tipe')}}" />
                            <span style="color: red;">{{ $errors->first('tipe')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"  style="font-size: 16px">Harga</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Add-On"  value="{{old('harga')}}" />
                            <span style="color: red;">{{ $errors->first('harga')}}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px" >Keterangan</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Add-On"  value="{{old('keterangan')}}" />
                            <span style="color: red;">{{ $errors->first('keterangan')}}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px" >Foto Add-On</label>
                        <input type="file" class="form-control" id="foto" name="foto" placeholder=""  />
                        <span style="color: red;">{{ $errors->first('foto')}}</span>
                    </div>


            </div>
            <br>



            <div style="float: right">
                <a href="{{url('/seller/produkCustom/addOn')}}" class="btn btn-outline-dark">Kembali</a>
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


