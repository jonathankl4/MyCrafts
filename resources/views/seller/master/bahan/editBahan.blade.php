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
        <h2 class="fw-bold  mb-4">Edit Bahan</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/editBahan/'.$bahan->id)}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Nama Bahan</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="namaBahan" name="namaBahan" placeholder="-" value="{{$bahan->nama_bahan}}" />
                        <span style="color: red;">{{ $errors->first('namaBahan')}}</span>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label" style="font-size: 16px" >Ukuran</label>
                    {{-- <input type="text" class="form-control" id="satuanBahan" name="satuanBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('satuanBahan')}}</span> --}}
                    <div class="col-md-10">

                        <select name="satuanBahan" id="" class="form-select theSelect">
                            @if (count($satuan) < 1)

                            <option>Belum ada Satuan</option>

                            @elseif (count($satuan) > 0)
                            <option disabled selected hidden >Pilih Satuan..</option>

                            @endif
                            @for ($i = 0; $i < count($satuan);$i++)
                            @php
                                $cek = 0;
                                $dis = "";
                                if ($bahan->satuan_bahan==$satuan[$i]->nama_satuan) {
                                    # code...
                                    $cek = 1;
                                    $dis = "selected";

                                }
                            @endphp

                                <option {{$dis}} value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>

                            @endfor
                        </select>
                        <br><br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spanpanjang" style="">Panjang :</span>
                            <input type="number" class="form-control" id="ukuranPanjang" name="ukuranPanjang" aria-describedby="spanpanjang" style="border: 1.3px ridge " value={{$bahan->ukuran_panjangBahan}} />
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranPanjang')}}</span>
                        <br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spanlebar" style="">Lebar :</span>
                            <input type="number" class="form-control" id="ukuranLebar" name="ukuranLebar" aria-describedby="spanlebar" style="border: 1.3px ridge " value={{$bahan->ukuran_lebarBahan}} />
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranLebar')}}</span>
                        <br>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="spantinggi" style="">Tinggi :</span>
                            <input type="number" class="form-control" id="ukuranTinggi" name="ukuranTinggi" min="0" aria-describedby="spantinggi" style="border: 1.3px ridge " value={{$bahan->ukuran_tinggiBahan}} />
                        </div>
                        <span style="color: red;">{{ $errors->first('ukuranTinggi')}}</span>

                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">jumlah</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="jumlahBahan" name="jumlahBahan" placeholder="-" value="{{$bahan->jumlah_bahan}}"/>
                        <select name="satuanJumlah" id="" class="form-select theSelect">
                            @if (count($satuan) < 1)

                            <option>Belum ada Satuan</option>

                            @elseif (count($satuan) > 0)
                            <option disabled selected hidden >Pilih Satuan..</option>

                            @endif
                            @for ($i = 0; $i < count($satuan);$i++)
                            @php
                                $cek2 = 0;
                                $dis2 = "";
                                if ($bahan->satuan_jumlah==$satuan[$i]->nama_satuan) {
                                    # code...
                                    $cek2 = 1;
                                    $dis2 = "selected";

                                }
                            @endphp

                                <option {{$dis2}} value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>

                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"  style="font-size: 16px">harga</label>
                    <div class="col-md-10">

                        <input type="text" class="form-control" id="hargaBahan" name="hargaBahan" placeholder="-"  value="{{$bahan->harga_bahan}}"/>
                        <span style="color: red;">{{ $errors->first('hargaBahan')}}</span>
                    </div>
                </div>

                <div style="float: right">
                    <a href="{{url('/seller/master/bahan')}}" class="btn btn-outline-dark">Kembali</a>
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


@section('script')

<script>

$(".theSelect").select2();
</script>

@endsection


