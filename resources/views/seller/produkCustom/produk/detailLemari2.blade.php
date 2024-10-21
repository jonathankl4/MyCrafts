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
            <h2 class="fw-bold py-3 mb-4">Detail Lemari 2</h2>

            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk Custom</a> --}}
            <form action="{{ url('/seller/produkCustom/ubahDetailLemari2') }}" method="post">
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
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="hargaJati" name="hargaJati"
                                    placeholder="Harga Kayu Jati"
                                    value="{{ $detailKayu->where('jenis_kayu', 'Kayu Jati')->first()->harga ?? '' }}"
                                    {{ $detailKayu->where('jenis_kayu', 'Kayu Jati')->isEmpty() ? 'readonly' : '' }} />
                            </div>
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
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="hargaMahoni" name="hargaMahoni"
                                    placeholder="Harga Kayu Mahoni"
                                    value="{{ $detailKayu->where('jenis_kayu', 'Kayu Mahoni')->first()->harga ?? '' }}"
                                    {{ $detailKayu->where('jenis_kayu', 'Kayu Mahoni')->isEmpty() ? 'readonly' : '' }} />
                            </div>
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
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="hargaPinus" name="hargaPinus"
                                    placeholder="Harga Kayu Pinus"
                                    value="{{ $detailKayu->where('jenis_kayu', 'Kayu Pinus')->first()->harga ?? '' }}"
                                    {{ $detailKayu->where('jenis_kayu', 'Kayu Pinus')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('hargaPinus') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Sungkai -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-sungkai"
                                onclick="toggleInput(this, 'hargaSungkai')"
                                {{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-sungkai" style="font-size: 16px;">Kayu
                                Sungkai</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="hargaSungkai" name="hargaSungkai"
                                    placeholder="Harga Kayu Sungkai"
                                    value="{{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->first()->harga ?? '' }}"
                                    {{ $detailKayu->where('jenis_kayu', 'Kayu Sungkai')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('hargaSungkai') }}</span>
                        </div>
                    </div>

                </div>
                <br>
                <div class="card" style="padding: 15px">
                    <h4>Add on dan Harga</h4>

                    <!-- Sekat Vertical -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-sekat-vertical"
                                onclick="toggleInput(this, 'sekatVertical')"
                                {{ $detailAddon->where('nama_addon', 'Sekat Vertical')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-sekat-vertical" style="font-size: 16px;">Sekat
                                Vertical</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="sekatVertical" name="sekatVertical"
                                    placeholder="Harga Sekat Vertical"
                                    value="{{ $detailAddon->where('nama_addon', 'Sekat Vertical')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Sekat Vertical')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('sekatVertical') }}</span>
                        </div>
                    </div>

                    <!-- Sekat Horizontal -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-sekat-horizontal"
                                onclick="toggleInput(this, 'sekatHorizontal')"
                                {{ $detailAddon->where('nama_addon', 'Sekat Horizontal')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-sekat-horizontal" style="font-size: 16px;">Sekat
                                Horizontal</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="sekatHorizontal" name="sekatHorizontal"
                                    placeholder="Harga Sekat Horizontal"
                                    value="{{ $detailAddon->where('nama_addon', 'Sekat Horizontal')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Sekat Horizontal')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('sekatHorizontal') }}</span>
                        </div>
                    </div>

                    <!-- Gantungan -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-gantungan"
                                onclick="toggleInput(this, 'gantungan')"
                                {{ $detailAddon->where('nama_addon', 'Gantungan')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-gantungan"
                                style="font-size: 16px;">Gantungan</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="gantungan" name="gantungan"
                                    placeholder="Harga Gantungan"
                                    value="{{ $detailAddon->where('nama_addon', 'Gantungan')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Gantungan')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('gantungan') }}</span>
                        </div>
                    </div>
                    {{-- Laci Kecil --}}
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-lacikecil"
                                onclick="toggleInput(this, 'lacikecil')"
                                {{ $detailAddon->where('nama_addon', 'lacikecil')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-lacikecil" style="font-size: 16px;">Laci
                                Kecil</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="lacikecil" name="lacikecil"
                                    placeholder="Harga Laci Kecil"
                                    value="{{ $detailAddon->where('nama_addon', 'lacikecil')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'lacikecil')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('lacikecil') }}</span>
                        </div>
                    </div>

                    {{-- Laci Besar --}}
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-lacibesar"
                                onclick="toggleInput(this, 'lacibesar')"
                                {{ $detailAddon->where('nama_addon', 'lacibesar')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-lacibesar" style="font-size: 16px;">Laci
                                Besar</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="lacibesar" name="lacibesar"
                                    placeholder="Harga Laci Besar"
                                    value="{{ $detailAddon->where('nama_addon', 'lacibesar')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'lacibesar')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('lacibesar') }}</span>
                        </div>
                    </div>


                </div>
                <br>
                <div class="card" style="padding: 15px">
                    <h4>Pintu dan Harga</h4>

                    <!-- Pintu 1 -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pintu1"
                                onclick="toggleInput(this, 'pintu1')"
                                {{ $detailAddon->where('nama_addon', 'Pintu 1')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-pintu1" style="font-size: 16px;">Pintu 1</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="pintu1" name="pintu1"
                                    placeholder="Harga Pintu 1"
                                    value="{{ $detailAddon->where('nama_addon', 'Pintu 1')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Pintu 1')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('pintu1') }}</span>
                        </div>
                    </div>

                    <!-- Pintu 2 -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pintu2"
                                onclick="toggleInput(this, 'pintu2')"
                                {{ $detailAddon->where('nama_addon', 'Pintu 2')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-pintu2" style="font-size: 16px;">Pintu 2</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="pintu2" name="pintu2"
                                    placeholder="Harga Pintu 2"
                                    value="{{ $detailAddon->where('nama_addon', 'Pintu 2')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Pintu 2')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('pintu2') }}</span>
                        </div>
                    </div>

                    <!-- Pintu 3 -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pintu3"
                                onclick="toggleInput(this, 'pintu3')"
                                {{ $detailAddon->where('nama_addon', 'Pintu 3')->isNotEmpty() ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="toggle-pintu3" style="font-size: 16px;">Pintu 3</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="pintu3" name="pintu3"
                                    placeholder="Harga Pintu 3"
                                    value="{{ $detailAddon->where('nama_addon', 'Pintu 3')->first()->harga ?? '' }}"
                                    {{ $detailAddon->where('nama_addon', 'Pintu 3')->isEmpty() ? 'readonly' : '' }} />
                            </div>
                            <span style="color: red;">{{ $errors->first('pintu3') }}</span>
                        </div>
                    </div>



                </div>
                <br>
                <div style="float: right">
                    <a href="{{ url('/seller/produkCustom/daftarProdukCustom') }}" class="btn btn-warning">Kembali</a>

                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

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
