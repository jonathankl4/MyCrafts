@extends('template.BackupMasterDesain')

@section('title', 'Tambah Produksi')

@section('style')
<style>






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
        <h2 class="fw-bold  mb-4">Tambah Perencanaan Produksi</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addProduksi')}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px">Pilih Dari Bill Of Material</label>
                    <div class="col-md-10">

                        <select name="billOfMaterial" id="billOfMaterial" class="theSelect form-select" style="height: 50px;"  onchange=ambildata() >
                            @if (count($listBom) > 0)
                            <option value="" disabled selected>Pilih</option>
                            @for ($i=0; $i<count($listBom); $i++)

                            <option value="{{$listBom[$i]->id}}">{{$listBom[$i]->nama_product}}</option>
                            @endfor
                            @elseif (count($listBom) < 1)
                            <option value="" disabled selected hidden>Belum ada Bom yang tersedia</option>
                            @endif
                        </select>

                        <span style="color: red;">{{ $errors->first('billOfMaterial')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">Nama Produk</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk" value="{{old('namaProduk')}}" disabled />
                        {{-- <span style="color: red;">{{ $errors->first('tglProduksi')}}</span> --}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">Tanggal Produksi</label>
                    <div class="col-md-10">

                        <input type="date" class="form-control" id="tglProduksi" name="tglProduksi" placeholder="Nama supplier" value="{{old('tglProduksi')}}" />
                        <span style="color: red;">{{ $errors->first('tglProduksi')}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Jumlah Produksi</label>
                    <div class="col-md-10">

                        <input type="number" class="form-control" id="jumlahProduksi" name="jumlahProduksi" placeholder="jumlah yang diproduksi" value="{{old('jumlahProduksi')}}" />
                        <span style="color: red;">{{ $errors->first('jumlahProduksi')}}</span>
                    </div>

                </div>

                <div style="float: right">
                    <a href="{{url('/seller/produksi/perencanaanProduksi')}}" class="btn btn-outline-dark">Kembali</a>
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

@section('script')

<script>
    $(".theSelect").select2();


  </script>

<script language='javascript'>

    function ambildata(){

        let anjay = $('#billOfMaterial').val();

        // window.alert(anjay);

        $.ajax({
            type: 'get',
            url : '{{url('seller/getBom')}}',
            data : {'id': anjay},
            success: function(data){

                // console.log(data)
                $('#namaProduk').val(data['nama_product']);




            }
        })
    }
</script>
@endsection


