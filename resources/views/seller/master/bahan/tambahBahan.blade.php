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
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Ukuran (opsional) </label>
                    {{-- <input type="text" class="form-control" id="satuanBahan" name="satuanBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('satuanBahan')}}</span> --}}
                    <div class="col-md-10">

                        <select name="satuanBahan" id="satuanBahan" class="form-select theSelect">
                            @if (count($satuan) < 1)

                            <option>Belum ada Satuan</option>

                            @elseif (count($satuan) > 0)
                            <option disabled selected hidden >Pilih Satuan..</option>

                            @endif
                            @for ($i = 0; $i < count($satuan);$i++)

                                <option value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>

                            @endfor
                        </select>
                        <br><br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spanpanjang" style="">Panjang :</span>
                            <input type="number" class="form-control" id="ukuranPanjang" name="ukuranPanjang" aria-describedby="spanpanjang" style="border: 1.3px ridge " value="{{old('ukuranPanjang')}}"  />
                            <span class="input-group-text " id="labelPanjang"></span>
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranPanjang')}}</span>
                        <br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spanlebar" style="">Lebar :</span>
                            <input type="number" class="form-control" id="ukuranLebar" name="ukuranLebar" aria-describedby="spanlebar" style="border: 1.3px ridge " value="{{old('ukuranLebar')}}"  />
                            <span class="input-group-text" id="labelLebar"></span>
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranLebar')}}</span>
                        <br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spantinggi" style="">Tinggi :</span>
                            <input type="number" class="form-control" id="ukuranTinggi" name="ukuranTinggi" aria-describedby="spantinggi" style="border: 1.3px ridge " value="{{old('ukuranTinggi')}}"  />
                            <span class="input-group-text " id="labelTinggi"></span>
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranTinggi')}}</span>

                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >jumlah</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="jumlahBahan" name="jumlahBahan" placeholder="-" value="{{old('jumlahBahan')}}" />


                            <select name="satuanJumlah" id="satuanJumlah" class="form-select theSelect" required >
                                @if (count($satuan) < 1)

                                <option>Belum ada Satuan</option>

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
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >harga</label>
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


