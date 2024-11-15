@extends('template.MasterDesain')

@section('title', 'Daftar Template Produk Custom')

@section('style')
    <style>
        /* Tambahkan styling tambahan di sini jika dibutuhkan */
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
            <h2 class="fw-bold py-3 mb-4">Detail Meja 1</h2>

            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk Custom</a> --}}
            <form action="{{url('/seller/produkCustom/ubahDetailMeja1')}}" method="post">
                @csrf
                <div class="card" style="padding: 15px">
                    <h4>Jenis Kayu dan Harga</h4>


                    <!-- Kayu Jati -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-jati"
                                onclick="toggleInput(this, 'hargaJati')"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Jati')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-jati" style="font-size: 16px;">Kayu Jati</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="hargaJati" name="hargaJati"
                                placeholder="Harga Kayu Jati"
                                value="{{ $detailKayu->where('jenis_kayu', 'Kayu Jati')->first()->harga ?? '' }}"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Jati')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('hargaJati') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Mahoni -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-mahoni"
                                onclick="toggleInput(this, 'hargaMahoni')"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Mahoni')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-mahoni" style="font-size: 16px;">Kayu Mahoni</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="hargaMahoni" name="hargaMahoni"
                                placeholder="Harga Kayu Mahoni" value="{{ $detailKayu->where('jenis_kayu', 'Kayu Mahoni')->first()->harga ?? '' }}"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Mahoni')->isEmpty() ? 'readonly' : '' }}/>
                            <span style="color: red;">{{ $errors->first('hargaMahoni') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Pinus -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pinus"
                                onclick="toggleInput(this, 'hargaPinus')"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Pinus')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-pinus" style="font-size: 16px;">Kayu Pinus</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="hargaPinus" name="hargaPinus"
                                placeholder="Harga Kayu Pinus"
                                value="{{ $detailKayu->where('jenis_kayu', 'Kayu Pinus')->first()->harga ?? '' }}"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Pinus')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('hargaPinus') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Sungkai -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-sungkai"
                                onclick="toggleInput(this, 'hargaSungkai')"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-sungkai" style="font-size: 16px;">Kayu Sungkai</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="hargaSungkai" name="hargaSungkai"
                                placeholder="Harga Kayu Sungkai"
                                value="{{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->first()->harga ?? '' }}"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('hargaSungkai') }}</span>
                        </div>
                    </div>

                </div>
                <br>
                <div class="card" style="padding: 15px">
                    <h4>Add on dan Harga</h4>



                    {{-- Laci kecil --}}
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-laci1"
                                onclick="toggleInput(this, 'laci1')"
                                {{ $detailAddon->where('nama_addon', 'Laci 1')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-laci1" style="font-size: 16px;">Laci 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="laci1" name="laci1"
                                placeholder="Harga Laci 1"
                                value="{{ $detailAddon->where('nama_addon', 'Laci 1')->first()->harga ?? '' }}"
                                {{ $detailAddon->where('nama_addon', 'Laci 1')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('laci1') }}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalLaci1">Detail</button>
                        </div>
                    </div>
                    {{-- Laci kecil 2 --}}
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-laci2"
                                onclick="toggleInput(this, 'laci2')"
                                {{ $detailAddon->where('nama_addon', 'Laci 2')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-laci2" style="font-size: 16px;">Laci 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="laci2" name="laci2"
                                placeholder="Harga Laci 2"
                                value="{{ $detailAddon->where('nama_addon', 'Laci 2')->first()->harga ?? '' }}"
                                {{ $detailAddon->where('nama_addon', 'Laci 2')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('laci2') }}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalLaci2">Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pijakankaki"
                                onclick="toggleInput(this, 'pijakankaki')"
                                {{ $detailAddon->where('nama_addon', 'Pijakan Kaki')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-pijakankaki" style="font-size: 16px;">Pijakan Kaki</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="pijakankaki" name="pijakankaki"
                                placeholder="Harga pijakan kaki"
                                value="{{ $detailAddon->where('nama_addon', 'Pijakan Kaki')->first()->harga ?? '' }}"
                                {{ $detailAddon->where('nama_addon', 'Pijakan Kaki')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('pijakankaki') }}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalPijakanKaki">Detail</button>
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-penutup"
                                onclick="toggleInput(this, 'penutupbelakang')"
                                {{ $detailAddon->where('nama_addon', 'Penutup Belakang')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-penutup" style="font-size: 16px;">Penutup Belakang </label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="penutupbelakang" name="penutupbelakang"
                                placeholder="Harga Penutup Belakang"
                                value="{{ $detailAddon->where('nama_addon', 'Penutup Belakang')->first()->harga ?? '' }}"
                                {{ $detailAddon->where('nama_addon', 'Penutup Belakang')->isEmpty() ? 'readonly' : '' }} />
                            <span style="color: red;">{{ $errors->first('penutupbelakang') }}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalPenutupBelakang">Detail</button>
                        </div>
                    </div>

                </div>
                <br>

                <br>
                <div style="float: right">
                    <a href="{{url('/seller/produkCustom/daftarProdukCustom')}}" class="btn btn-warning">Kembali</a>

                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @include('seller.produkCustom.produk.modal.modalAddOnMeja')

    {{-- @include('seller.produkCustom.produk.modal.modalPintuLemari3') --}}

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tMebel').DataTable();
        });

        function toggleInput(checkbox, inputId) {
            var inputField = document.getElementById(inputId);
            if (checkbox.checked) {
                inputField.removeAttribute('readonly');
            } else {
                inputField.setAttribute('readonly', true);
                inputField.value = '';
            }
        }
    </script>
@endsection
