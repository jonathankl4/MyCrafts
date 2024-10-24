@extends('template.BackupMasterDesain')

@section('title', 'Dashboard')

@section('style')
    <style>
        .dataTables_wrapper .dataTables_filter {
            position: absolute;
            top: 130px;
            right: 40px;

        }

        #image-label {
            position: relative;
            width: 200px;
            height: 200px;
            background: #fff;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            display: flex;
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

        #image-label:hover {
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
            <h2 class="fw-bold  mb-4">Tambah Produk</h2>
            <form action="{{ url('seller/addProduk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card" style="padding: 15px">



                    <h3 class="card-header text-dark ">Informasi Produk</h3>

                    <div class="mb-3 row ">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Nama Produk</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk"
                                placeholder="Nama Produk" value="{{ old('namaProduk') }}" required />
                            <span style="color: red;">{{ $errors->first('namaProduk') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">tipe Produk</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="tipeProduk" name="tipeProduk"
                                placeholder="Tipe Produk" value="{{ old('tipeProduk') }}" required />
                            <span style="color: red;">{{ $errors->first('tipeProduk') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Harga</label>
                        <div class="col-md-10">

                            <input type="number" class="form-control" id="hargaProduk" name="hargaProduk"
                                placeholder="Harga" value="{{ old('hargaProduk') }}" required />
                            <span style="color: red;">{{ $errors->first('hargaProduk') }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">stok dijual</label>
                        <div class="col-md-10">

                            <input type="number" class="form-control" id="jumlahProduk" name="jumlahProduk"
                                placeholder="Jumlah Produk" value="{{ old('jumlahProduk') }}" required/>
                            <span style="color: red;">{{ $errors->first('jumlahProduk') }}</span>
                        </div>
                    </div>


                </div>
                <br>
                <div class="card" style="padding: 15px">



                    <h3 class="card-header text-dark ">Berat Produk</h3>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Berat</label>
                        <div class="col-md-10">

                            <div class="input-group">

                                <input type="number" class="form-control" id="beratProduk" name="beratProduk"
                                    aria-describedby="beratprodukinfo" placeholder="Berat Produk"
                                    value="{{ old('beratProduk') }}" required />
                                <span class="input-group-text" id="beratprodukinfo">Gram</span>
                            </div>
                            <span style="color: red;">{{ $errors->first('beratProduk') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" style="font-size: 16px">Ukuran</label>

                        <div class="col-md-10">
                            <select name="satuanProduk" id="satuanProduk" class="theSelect form-select"
                                style="height: 50px;width: 50%" required>
                                <option value="" disabled selected hidden>Satuan Ukuran</option>
                                @for ($i = 0; $i < count($satuan); $i++)
                                    <option value="{{ $satuan[$i]->nama_satuan }}">{{ $satuan[$i]->nama_satuan }}
                                    </option>
                                @endfor

                            </select>
                            <a href="{{ url('/seller/master/Satuan') }}" class="btn btn-primary">Tambah Satuan baru</a>

                            <br><span style="color: red;">{{ $errors->first('SatuanProduk') }}</span><br>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="spanpanjang" style="">Panjang :</span>
                                <input type="number" class="form-control" id="ukuranPanjang" name="ukuranPanjang"
                                    aria-describedby="spanpanjang" style="border: 1.3px ridge "
                                    value="{{ old('ukuranPanjang') }}" required />
                                <span class="input-group-text " id="labelPanjang"></span>
                            </div>
                            <span style="color: red;">{{ $errors->first('ukuranPanjang') }}</span>
                            <br>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="spanlebar" style="">Lebar :</span>
                                <input type="number" class="form-control" id="ukuranLebar" name="ukuranLebar"
                                    aria-describedby="spanlebar" style="border: 1.3px ridge "
                                    value="{{ old('ukuranLebar') }}" required />
                                <span class="input-group-text" id="labelLebar"></span>
                            </div>
                            <span style="color: red;">{{ $errors->first('ukuranLebar') }}</span>
                            <br>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="spantinggi" style="">Tinggi :</span>
                                <input type="number" class="form-control" id="ukuranTinggi" name="ukuranTinggi"
                                    aria-describedby="spantinggi" style="border: 1.3px ridge "
                                    value="{{ old('ukuranTinggi') }}" required/>
                                <span class="input-group-text " id="labelTinggi"></span>
                            </div>
                            <span style="color: red;">{{ $errors->first('ukuranTinggi') }}</span>

                        </div>
                    </div>


                </div>
                <br>
                <div class="card" style="padding: 15px">
                    <h3 class="card-header text-dark ">Detail Produk</h3>


                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">foto Utama</label>

                        <input type="file" class="form-control" id="fotoUtama" name="fotoUtama" required/>
                        <span style="color: red;">{{ $errors->first('fotoUtama') }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">foto 2</label>
                        <input type="file" class="form-control" id="fotoProduk2" name="fotoProduk2" />
                    </div>
                    <div class="mb-3">

                        <label class="form-label" style="font-size: 16px">foto 3</label>
                        <input type="file" class="form-control" id="fotoProduk3" name="fotoProduk3" />
                    </div>
                    <div class="mb-3">

                        <label class="form-label" style="font-size: 16px">foto 4</label>
                        <input type="file" class="form-control" id="fotoProduk4" name="fotoProduk4" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 16px">Deskripsi Produk</label>
                        <br>
                        <textarea name="keteranganProduk" id="keteranganProduk" cols="30" rows="10"></textarea>

                            <span style="color: red;">{{ $errors->first('keteranganProduk') }}</span>

                    </div>
                </div>
                <br>
                <div style="float: right">
                    <a href="{{ url('/seller/produk/daftarProduk') }}" class="btn btn-outline-dark">Kembali</a>
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



        $('#satuanProduk').on('change', function() {
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
