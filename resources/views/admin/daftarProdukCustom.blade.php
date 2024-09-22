@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

@section('style')
    <style>






    </style>
@endsection

@section('sidebar')

    @include('admin.template.sidebar')

@endsection

@section('navbar')
    @include('admin.template.navbar')
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
                                <th>Harga</th>
                                <th>Foto</th>
                                
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($listProduk); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td style="font-size: 16px"><b>{{ $listProduk[$i]->nama_template }}</b></td>
                                    <td style="font-size: 16px"><b>{{ $listProduk[$i]->harga }}</b></td>
                                    <td style="font-size: 16px"><img src="{{url('/storage/fotoTemplateMaster/'.$listProduk[$i]->foto)}}" alt="" style="width:70px; height:70px"></td>
                                    <td><a href="" class="btn btn-info">Detail Add-On</a></td>

                                </tr>
                            @endfor







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
                        <form action="{{ url('masteruser/tambahTemplate') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Template</label>
                                <div class="col-md-10">


                                    <input type="text" class="form-control" id="namaTemplate" required name="namaTemplate"
                                         required/>
                                    <span style="color: red;">{{ $errors->first('namaTemplate') }}</span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Harga</label>
                                <div class="col-md-10">

                                    <input type="number" class="form-control" id="harga" required
                                        name="harga" placeholder="harga"
                                         />
                                    <span style="color: red;">{{ $errors->first('harga') }}</span>
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" style="font-size: 16px">Foto</label>
                                <div class="col-md-10">

                                    <input type="file" class="form-control" id="foto" required
                                        name="foto"
                                         />
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
