@extends('template.BackupMasterDesain')

@section('title', 'Edit Template')

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
        <h2 class="fw-bold  mb-4">Edit Template Produk Custom</h2>
        <form action="{{url('seller/editAddOn/'.$addon->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card" style="padding: 15px">
                <h3 class="card-header text-dark ">Informasi Template</h3>

                    <div class="mb-3">
                        <label class="form-label" >Nama Template</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="nama Template"  value="{{$addon->nama}}"/>
                        <span style="color: red;">{{ $errors->first('nama')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >tipe</label>
                        <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Tipe Template" value="{{$addon->tipe}}" />
                        <span style="color: red;">{{ $errors->first('tipe')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga"  value="{{$addon->harga}}" />
                        <span style="color: red;">{{ $errors->first('harga')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Template"  value="{{$addon->keterangan}}" />
                        <span style="color: red;">{{ $errors->first('keterangan')}}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Foto Template</label>
                        <div class="col-md-10">
                            @if($addon->gambar != null )
                            <img src="{{url("/storage/imgAddOn/".$addon->gambar)}}" alt="" style="width:100px; height:100px" >

                            @else
                            <p>gambar kosong</p>
                            @endif
                        </div>
                        <input type="file" class="form-control" id="foto" name="foto" placeholder=""  />
                        <span style="color: red;">{{ $errors->first('foto')}}</span>
                    </div>


            </div>
            <br>



            <div style="float: right">
                <a href="{{url('/seller/produkCustom/addOn')}}" class="btn btn-outline-dark">Kembali</a>
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
</script>


@endsection


