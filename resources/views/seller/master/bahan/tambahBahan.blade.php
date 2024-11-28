@extends('template.BackupMasterDesain')

@section('title', 'Tambah Bahan')

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
        <h2 class="fw-bold  mb-4">Tambah Bahan</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addBahan')}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Nama Bahan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaBahan" name="namaBahan" placeholder="-" value="{{old('namaBahan')}}" />
                        <span style="color: red;">{{ $errors->first('namaBahan')}}</span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Ukuran</label>
                    {{-- <input type="text" class="form-control" id="satuanBahan" name="satuanBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('satuanBahan')}}</span> --}}
                    <div class="col-md-10">



                        <div class="input-group input-group-merge">

                            <input type="text" class="form-control" id="ukuran" name="ukuran" aria-describedby="spanpanjang" style="border: 1.3px ridge " value="{{old('ukuranPanjang')}}" placeholder="contoh: 10 x 10 x 10 (cm)"  />
                            <span class="input-group-text " id="labelPanjang"></span>
                        </div>


                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Stok</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="jumlahBahan" name="jumlahBahan" placeholder="-" value="{{old('jumlahBahan')}}" />
                        <select name="satuanJumlah" id="satuanJumlah" class="form-select theSelect" required >
                            @if (count($satuan) < 1)

                            <option disabled selected hidden>Belum ada Satuan</option>

                            @elseif (count($satuan) > 0)
                            <option disabled selected hidden >Pilih Satuan..</option>

                            @endif
                            @for ($i = 0; $i < count($satuan);$i++)

                                <option value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>

                            @endfor
                        </select>




                        <span style="color: red;">{{ $errors->first('jumlahBahan')}}</span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >harga per satuan</label>
                    <div class="col-md-10">

                        <input type="number" class="form-control" id="hargaBahan" name="hargaBahan" placeholder="-" value="{{old('hargaBahan')}}" />
                        <span style="color: red;">{{ $errors->first('hargaBahan')}}</span>
                    </div>
                </div>

                <div style="float: right">
                    <a href="{{url('/seller/master/bahan')}}" class="btn btn-outline-dark">Kembali</a>
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

    $('#satuanBahan').on('change', function() {
            let selectedValue = $(this).val();
            document.getElementById('labelPanjang').textContent =
            selectedValue;
            document.getElementById('labelLebar').textContent =
            selectedValue;
            document.getElementById('labelTinggi').textContent =
            selectedValue;  // Gunakan nilai yang dipilih dari Select2
        });
</script>

@endsection


