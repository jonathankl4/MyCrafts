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
        <h2 class="fw-bold  mb-4">Tambah Bahan</h2>

        <div class="card" style="padding: 15px">

            <form action="{{url('seller/addBahan')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Nama Bahan</label>
                    <input type="text" class="form-control" id="namaBahan" name="namaBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('namaBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Ukuran</label>
                    <input type="text" class="form-control" id="ukuranBahan" name="ukuranBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('ukuranBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >satuan</label>
                    {{-- <input type="text" class="form-control" id="satuanBahan" name="satuanBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('satuanBahan')}}</span> --}}
                    <select name="" id="" class="form-select theSelect">
                        @for ($i = 0; $i < count($satuan);$i++)

                            <option value="{{$satuan[$i]->nama_satuan}}">{{$satuan[$i]->nama_satuan}}</option>

                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" >jumlah</label>
                    <input type="text" class="form-control" id="jumlahBahan" name="jumlahBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('jumlahBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >jenis</label>
                    <input type="text" class="form-control" id="jenisBahan" name="jenisBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('jenisBahan')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" >harga</label>
                    <input type="text" class="form-control" id="hargaBahan" name="hargaBahan" placeholder="-" />
                    <span style="color: red;">{{ $errors->first('hargaBahan')}}</span>
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
</script>

@endsection


