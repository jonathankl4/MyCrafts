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
            <h2 class="fw-bold py-3 mb-4">Detail Lemari 1</h2>

            {{-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk Custom</a> --}}

            <div class="card" style="padding: 15px">
                <h4>Jenis Kayu dan Harga</h4>

                <form action="" method="post">
                    <!-- Kayu Jati -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-jati" onclick="toggleInput(this, 'hargaJati')">
                            <label class="form-label mb-0" for="toggle-jati" style="font-size: 16px;">Kayu Jati</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="hargaJati" name="hargaJati" placeholder="Harga Kayu Jati" value="" readonly/>
                            <span style="color: red;">{{ $errors->first('hargaJati') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Mahoni -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-mahoni" onclick="toggleInput(this, 'hargaMahoni')">
                            <label class="form-label mb-0" for="toggle-mahoni" style="font-size: 16px;">Kayu Mahoni</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="hargaMahoni" name="hargaMahoni" placeholder="Harga Kayu Mahoni" value="" readonly/>
                            <span style="color: red;">{{ $errors->first('hargaMahoni') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Pinus -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-pinus" onclick="toggleInput(this, 'hargaPinus')">
                            <label class="form-label mb-0" for="toggle-pinus" style="font-size: 16px;">Kayu Pinus</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="hargaPinus" name="hargaPinus" placeholder="Harga Kayu Pinus" value="" readonly/>
                            <span style="color: red;">{{ $errors->first('hargaPinus') }}</span>
                        </div>
                    </div>

                    <!-- Kayu Sungkai -->
                    <div class="mb-3 row align-items-center">
                        <div class="col-md-2 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="toggle-sungkai" onclick="toggleInput(this, 'hargaSungkai')">
                            <label class="form-label mb-0" for="toggle-sungkai" style="font-size: 16px;">Kayu Sungkai</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="hargaSungkai" name="hargaSungkai" placeholder="Harga Kayu Sungkai" value="" readonly/>
                            <span style="color: red;">{{ $errors->first('hargaSungkai') }}</span>
                        </div>
                    </div>

                </form>
            </div>
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
            }
        }
    </script>
@endsection
