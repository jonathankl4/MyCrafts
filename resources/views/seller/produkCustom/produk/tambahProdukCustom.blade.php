@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

@section('style')
    <style>






    </style>
@endsection

@section('sidebar')

    @include('seller.template.sidebar')

@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Daftar Template Produk Custom</h2>


            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk
                Custom</a>
            <br><br>
            <div class="card" style="padding: 15px">
                <h5 class="card-header"></h5>



                {{-- ini jika mau table nya responsive --}}
                {{-- <div class="table-responsive text-nowrap p-3"> --}}
                <div class="">
                    <table id="tMebel" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Template</th>
                               
                                

                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>
                            

                            
                                <tr>
                                    <td>1</td>
                                    <td style="font-size: 16px">
                                        <img
                                            src="{{ url('/img/lemari1/lemari1.png') }}"
                                            alt="" style="width:50px; height:80px">
                                        <b>Lemari 1</b>
                                    </td>
                                    
                                    
                                    <td>
                                        
                                        <a href="{{url('/seller')}}" class="btn btn-success">Tambah</a>
                                        <a href="{{url('/seller/produkCustom/Testing')}}" class="btn btn-dark">Coba Custom</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td style="font-size: 16px">
                                        <img
                                            src="{{ url('/img/lemari2/lemari2.png') }}"
                                            alt="" style="width:50px; height:80px">
                                        <b>Lemari 2</b>
                                    </td>
                                    
                                    
                                    <td>
                                        
                                        <a href="" class="btn btn-success">Detail</a>
                                        <a href="{{url('/seller/produkCustom/Testing')}}" class="btn btn-dark">Coba Custom</a>
                                    </td>

                                </tr>
                          







                        </tbody>

                    </table>

                </div>
            </div>






        </div>

        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="card-title text-primary"> Tambah Template </h2>
                        <form action="{{ url('masteruser/tambahTemplate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Template</label>
                                <div class="col-md-10">


                                    <input type="text" class="form-control" id="namaTemplate" required
                                        name="namaTemplate" required />
                                    <span style="color: red;">{{ $errors->first('namaTemplate') }}</span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Jenis Kayu</label>
                                <div class="col-md-10">

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon13"><b>Kayu Jati</b>, Harga :</span>
                                        <input type="number" class="form-control" id="hargakayujati" required name="hargakayujati"
                                            placeholder="harga" />
                                            <span class="input-group-text" id="basic-addon13">Rupiah</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon13"><b>Kayu Mahoni</b>, Harga :</span>
                                        <input type="number" class="form-control" id="hargakayumahoni" required name="hargakayumahoni"
                                            placeholder="harga" />
                                            <span class="input-group-text" id="basic-addon13">Rupiah</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon13"><b>Kayu Pinus</b>, Harga :</span>
                                        <input type="number" class="form-control" id="hargakayupinus" required name="hargakayupinus"
                                            placeholder="harga" />
                                            <span class="input-group-text" id="basic-addon13">Rupiah</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon13"><b>Kayu Sungkai</b>, Harga :</span>
                                        <input type="number" class="form-control" id="hargakayusungkai" required name="hargakayusungkai"
                                            placeholder="harga" />
                                            <span class="input-group-text" id="basic-addon13">Rupiah</span>
                                    </div>
                                        <span style="color: red;">{{ $errors->first('harga') }}</span>
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Foto</label>
                                <div class="col-md-10">

                                    <input type="file" class="form-control" id="foto" required name="foto" />
                                    <span style="color: red;">{{ $errors->first('foto') }}</span>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>


                    </div>
                </div>
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
        $(document).ready(function() {
            $('#tMebel').DataTable();


        });
    </script>
@endsection
