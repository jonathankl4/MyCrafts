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

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px"> Pilih Bahan</label>
                    <div class="col-md-10">

                        <select name="bahan" id="bahan" class="form-select theSelect" onchange=ambildata()>
                            <option value="" disabled selected hidden>Pilih Bahan</option>
                            @for ($i = 0; $i< count($listBahan); $i++)
                            <option value="{{$listBahan[$i]->id}}"> {{$listBahan[$i]->nama_bahan}} </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >nama Bahan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaBahan" name="namaBahan" placeholder="-" readonly/>
                        <span style="color: red;">{{ $errors->first('jumlah')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Ukuran</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="-" readonly/>
                        <span style="color: red;">{{ $errors->first('ukuran')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Harga</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="harga" name="harga" placeholder="-" readonly/>
                        <span style="color: red;">{{ $errors->first('ukuran')}}</span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah</label>
                    <div class="col-md-3">

                        <div class="input-group">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah yang digunakan" />
                            <span class="input-group-text" id="satuan_jumlah"></span>
                        </div>
                        <span style="color: red;">{{ $errors->first('jumlah')}}</span>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Subtotal</label>
                    <div class="col-md-10">

                        <input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="subtotal" />
                        <span style="color: red;">{{ $errors->first('subtotal')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Keterangan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan" />
                        <span style="color: red;">{{ $errors->first('keterangan')}}</span>
                    </div>
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


<script language='javascript' >

    function ambildata(){

        let anjay = $('#bahan').val();

        $.ajax({
            type :'get',
            url : '{{url('/seller/tambahDetailBom/getBahan')}}',
            data : {'id': anjay},
            success : function(data){

                console.log(data)
                $('#namaBahan').val(data['nama_bahan']);
                $('#ukuran').val(data['ukuran_bahan'] );
                $('#harga').val(data['harga_bahan']);
                $('#satuan_jumlah').html(data['satuan_jumlah']);


            }
        })
    }
</script>

@endsection


