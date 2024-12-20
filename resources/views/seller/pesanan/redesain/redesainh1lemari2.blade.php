@extends('template.MasterDesain')


@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Coba Custom Lemari 1')

@section('style')
    <style>
        .drawing-area {
            position: absolute;
            top: 20px;
            left: 50px;
            z-index: 10;
            width: 200px;
            height: 300px;
        }

        .canvas-container {
            width: 200px;
            height: 400px;
            position: relative;
            user-select: none;
            display: inline-block;
        }

        #produk-div {
            width: 452px;
            height: 630px;
            position: relative;
            background-color: #fff;
        }

        #canvas {
            position: absolute;
            width: 200px;
            height: 370px;
            left: 0px;
            top: 0px;
            user-select: none;
            cursor: default;
        }

        #counters {
            margin-top: 20px;
        }

        #counters div {
            font-size: 14px;
            margin-bottom: 5px;
        }
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
        <br>
        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Terima Dengan Perbaikan Desain</h2>

            <div class="row">

                <div class="col-md-7" style="overflow: auto; z-index: 3;">
                    <div class="card">
                        <h5 class="card-header"><b>Desain Baru</b></h5>

                        <div style="padding: 15px">




                            <div id="produk-div">
                                <!--
                                                                        Initially, the image will have the background tshirt that has transparency
                                                                        So we can simply update the color with CSS or JavaScript dinamically
                                                                    -->
                                {{-- <img id="template" src="{{url("img/bajuhitam.png")}}"/> --}}
                                <img id="template" src="{{ url('img/lemari2/lemari2.png') }}"
                                    style="width: 100%;height: 100%;" />

                                <div id="drawingArea" class="drawing-area">
                                    <div class="canvas-container" style="position: relative">
                                        <canvas id="tshirt-canvas" width="350px" height="590px"
                                            style="border-style: solid; border-width: 2px"></canvas>

                                        <div id="right-line"
                                            style="position: absolute; right: -210px; top: -20px; height:630px; width: 2px; background-color: black;">
                                        </div>
                                        <div id="right-text"
                                            style="position: absolute; right: -290px; top: 80%; transform: translateY(-50%); font-size: 20px;">
                                            {{ $pembelian->tinggi }}cm</div>

                                        <!-- Garis horizontal di bawah untuk 70cm -->
                                        <div id="bottom-line"
                                            style="position: absolute; left: -40px; bottom: -230px; width: 430px; height: 2px; background-color: black;">
                                        </div>
                                        <div id="bottom-text"
                                            style="position: absolute; left: 70%; bottom: -260px; transform: translateX(-50%); font-size: 20px;">
                                            {{ $pembelian->lebar }}cm</div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 40px">

                            </div>

                        </div>



                    </div>
                </div>
                <div class="col-md-5" style="z-index: 3">
                    <div class="card mb-4">
                        <h5 class="card-header"><b>Desain Milik Customer</b></h5>
                        <div style="padding: 15px">

                            <img src="{{ url('/storage/hasilcustom/' . $pembelian->fotoh1) }}"
                                style="width: 150px;height:225px">
                            <a href="" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalImage">Perbesar desain
                            </a>
                            <br>
                            <label style="font-size: 20px">Perkiraan Harga : Rp.
                                <b>{{ number_format($pembelian->perkiraan_harga, 0, ',', '.') }}</b> </label>
                            <br>
                            <span style="color: red; font-size: 14px">*perkiraan harga desain customer</span>



                        </div>



                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header"><b>Kustomisasi</b></h5>
                        <div style="padding: 15px">

                            {{-- tidak dipakai karena ini halaman redesain --}}
                            {{-- <div class="col-md-8">

                                <div>
                                    <label for="jeniskayu">Jenis Kayu</label>
                                    <select name="" id="jeniskayu" class="form-select">
                                        <option value="" selected disabled>Pilih </option>
                                        @if (count($detail) < 1)
                                            <option value="" selected disabled>Tidak Ada Pilihan kayu </option>
                                        @endif
                                        @for ($i = 0; $i < count($detail); $i++)
                                            <option value="{{ $detail[$i]->id }}"> {{ $detail[$i]->jenis_kayu }} (
                                                Rp.{{ number_format($detail[$i]->harga) }} )</option>
                                        @endfor

                                    </select>
                                </div>

                                <div>
                                    <label for="input-vertical-size">Ubah ukuran Tinggi (cm):</label>
                                    <input type="number" id="input-vertical-size" class="form-control" value="150">
                                </div>

                                <div>
                                    <label for="input-horizontal-size">Ubah ukuran panjang (cm):</label>
                                    <input type="number" id="input-horizontal-size" class="form-control" value="70">
                                </div>
                                <br>


                            </div> --}}
                            @php
                                $datapilihan = $detailPembelian->filter(function ($item) {
                                    return $item->jenis === 'second';
                                });
                            @endphp
                            <div>
                                <h5>Pilihan kayu, pintu dan finishing </h5>
                                <span>{{ $pembelian->jenis_kayu }} - Rp.
                                    {{ number_format($pembelian->harga_kayu, 0, ',', '.') }} </span>
                                <br>

                                <span>{{ $datapilihan[0]->nama_item }} - Rp.
                                    {{ number_format($datapilihan[0]->harga, 0, ',', '.') }} </span>
                                <br>
                                <span>{{ $pembelian->finishing }} - Rp.
                                    {{ number_format($pembelian->harga_finishing, 0, ',', '.') }} </span>
                            </div>

                            <div id="counters">
                                <div style="display: none">Jumlah Sekat Horizontal: <span
                                        id="count-sekat-horizontal">0</span></div>
                                <div style="display:none">Jumlah Sekat Vertical: <span id="count-sekat-vertical">0</span>
                                </div>
                                <div style="display: none">Jumlah Gantungan: <span id="count-gantungan">0</span></div>
                                <div style="display: none">Jumlah laci kecil: <span id="count-laci-kecil">0</span></div>
                                <div style="display: none">Jumlah laci besar: <span id="count-laci-besar">0</span></div>
                            </div>
                            <div class="col-md-10">
                                <label for="tshirt-design"><b> Add On</b></label>
                                <select id="tshirt-design" class="form-select">
                                    <option value="">pilih...</option>

                                    @for ($i = 0; $i < count($listAddOnMain); $i++)
                                        <option value="{{ url($listAddOnMain[$i]->url) }}">
                                            {{ $listAddOnMain[$i]->nama_addon }}
                                            (Rp.{{ number_format($listAddOnMain[$i]->harga) }}) </option>
                                    @endfor





                                </select>
                                <span>Opacity</span>
                                <input type="range" id="opacitySlider" min="0.1" max="1" step="0.01"
                                    value="1" onchange="updateOpacity(this.value)">
                                <br>
                                <button id="btntambah" class="btn btn-primary">tambah</button>

                                <button id="remove" class="btn btn-danger">delete</button>

                            </div>
                            <br><br>

                            <div id="total-price-container">

                                <h5>Perkiraan Harga <span id="total-price">Rp 0</span> </h5>

                            </div>
                            @include('seller.pesanan.redesain.template.form-redesain')



                            <br>



                        </div>



                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalBelomLogin" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2 class="card-title">Info </h2>
                            <p>Login Terlebih dahulu untuk Melanjutkan</p>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ url('/login') }}" class="btn btn-dark">Login</a>


                        </div>
                    </div>
                </div>
            </div>

            <div id="modalImage" class="modal fade" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="width: 100%; height: 100%;">




                <div class="modal-dialog">
                    <div class="modal-content" style="margin: auto;display: block;width: 80%;max-width: 700px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="modal-content" src="{{ url('/storage/hasilcustom/' . $pembelian->fotoh1) }}">


                        </div>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="modalConfirmPesanan" tabindex="-1" aria-labelledby="modalConfirmPesananLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #bfb596; color: white;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="padding: 20px;">
                            <h3 class="text-dark" style="font-weight: bold;">Konfirmasi</h3>
                            <p>Total yang harus dibayar Untuk desain Lama adalah: <span id="totalAmount1"
                                    style="font-weight: bold; color: #3c7e63;"></span></p>
                            <p>Total yang harus dibayar Untuk desain Baru adalah: <span id="totalAmount2"
                                    style="font-weight: bold; color: #3c7e63;"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" id="confirmOrder" class="btn btn-success">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <img id="template" src="{{url("img/test.png")}}" style="width: 1000px"/> --}}


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
        let canvas = new fabric.Canvas('tshirt-canvas');
        let currentDoor = null;
        let kayuData = @json($detail);
        let addonPrices = @json($addonPrices);
        // console.log(jeniskayu);
        console.log(addonPrices);
        let produk = @json($produk);
        console.log(produk);
        let user = @json($user);
        let pembelian = @json($pembelian);
        let datapilihan = @json($datapilihan);

        function updateGrid(canvas, widthCm, heightCm) {
            // Clear existing grid
            canvas.getObjects().forEach(obj => {
                if (obj.gridLine) {
                    canvas.remove(obj);
                }
            });

            const canvasWidth = canvas.getWidth();
            const canvasHeight = canvas.getHeight();
            widthCm -= 10;
            heightCm -= 5;

            // Calculate pixel to cm ratio for each axis independently
            const pixelPerCmX = canvasWidth / widthCm;
            const pixelPerCmY = canvasHeight / heightCm;
            let gridColor = '#231d00';
            let gridOpacity = 1;
            let gridLines = [];
            // Draw vertical lines every 5cm based on width
            for (let i = 0; i <= widthCm; i += 10) {
                const x = i * pixelPerCmX;
                const line = new fabric.Line([x, 0, x, canvasHeight], {
                    stroke: gridColor,
                    selectable: false,
                    strokeWidth: i % 10 === 0 ? 2 : 1, // Thicker line every 10cm
                    gridLine: true,
                    opacity: gridOpacity
                });
                canvas.add(line);
                gridLines.push(line);
            }

            // Draw horizontal lines every 5cm based on height
            for (let i = 0; i <= heightCm; i += 10) {
                const y = i * pixelPerCmY;
                const line = new fabric.Line([0, y, canvasWidth, y], {
                    stroke: gridColor,
                    selectable: false,
                    strokeWidth: i % 10 === 0 ? 2 : 1, // Thicker line every 10cm
                    gridLine: true,
                    opacity: gridOpacity
                });
                canvas.add(line);
                gridLines.push(line);
            }
            gridLines.forEach(line => {
                canvas.sendToBack(line); // Pindahkan garis ke lapisan paling belakang
            });

            canvas.renderAll();
        }


        canvas.on('object:moving', function(e) {
            var obj = e.target;
            var canvasWidth = canvas.getWidth();
            var canvasHeight = canvas.getHeight();

            if (obj.left < 0) {
                obj.left = 0;
            }
            if (obj.left + obj.width * obj.scaleX > canvasWidth) {
                obj.left = canvasWidth - obj.width * obj.scaleX;
            }

            if (obj.top < 0) {
                obj.top = 0;
            }

            if (obj.top + obj.height * obj.scaleY > canvasHeight) {
                obj.top = canvasHeight - obj.height * obj.scaleY;
            }
        });

        // Fungsi untuk membatasi skala objek saat diperbesar atau diperkecil
        canvas.on('object:scaling', function(e) {
            var obj = e.target;
            var canvasWidth = canvas.getWidth();
            var canvasHeight = canvas.getHeight();

            var objWidth = obj.width * obj.scaleX;
            var objHeight = obj.height * obj.scaleY;

            if (objWidth > canvasWidth) {
                obj.scalex = canvasWidth / obj.width;
            }
            if (objHeight > canvasHeight) {
                obj.scaleY = canvasHeight / obj.height;
            }

            obj.setCoords();
            canvas.renderAll();
        });



        // Inisialisasi kanvas
        canvas.renderAll();


        // Variabel counter untuk setiap jenis gambar
        let counterSekatHorizontal = 0;
        let counterSekatVertical = 0;
        let counterGantungan = 0;
        let counterlaciKecil = 0;
        let counterlaciBesar = 0;

        function updateOpacity(value) {
            canvas.getObjects().forEach(function(obj) {
                if (!obj.gridLine) {
                    obj.set({
                        opacity: value
                    });
                }

            })
            canvas.renderAll();
        }

        // Fungsi untuk memperbarui counter di UI
        function updateCounters() {
            const sekatHorizontalDiv = document.getElementById('count-sekat-horizontal').parentElement;
            const sekatVerticalDiv = document.getElementById('count-sekat-vertical').parentElement;
            const gantunganDiv = document.getElementById('count-gantungan').parentElement;
            const laciKecilDiv = document.getElementById('count-laci-kecil').parentElement;
            const laciBesarDiv = document.getElementById('count-laci-besar').parentElement;

            // Perbarui teks counter
            document.getElementById('count-sekat-horizontal').textContent = counterSekatHorizontal;
            document.getElementById('count-sekat-vertical').textContent = counterSekatVertical;
            document.getElementById('count-gantungan').textContent = counterGantungan;
            document.getElementById('count-laci-kecil').textContent = counterlaciKecil;
            document.getElementById('count-laci-besar').textContent = counterlaciBesar;

            // Tampilkan atau sembunyikan seluruh div berdasarkan jumlah add-on
            sekatHorizontalDiv.style.display = (counterSekatHorizontal > 0) ? 'block' : 'none';
            sekatVerticalDiv.style.display = (counterSekatVertical > 0) ? 'block' : 'none';
            gantunganDiv.style.display = (counterGantungan > 0) ? 'block' : 'none';
            laciKecilDiv.style.display = (counterlaciKecil > 0) ? 'block' : 'none';
            laciBesarDiv.style.display = (counterlaciBesar > 0) ? 'block' : 'none';
        }

        let currentVerticalSize = pembelian.tinggi;
        let currentHorizontalSize = pembelian.lebar;
        updateGrid(canvas, currentHorizontalSize, currentVerticalSize);

        let selectedKayuPrice = 0;

        // Fungsi untuk mengupdate garis dan teks
        function updateDimensions() {
            // Ambil nilai baru dari input
            // tidak di pakai karen ini halaman redesain
            // let newVerticalSize = document.getElementById('input-vertical-size').value;
            // let newHorizontalSize = document.getElementById('input-horizontal-size').value;

            // Update teks dan ukuran garis vertikal (kanan)
            document.getElementById('right-text').innerHTML = newVerticalSize + 'cm';
            // document.getElementById('right-line').style.height = (newVerticalSize * 3.67) + 'px';  // Sesuaikan skala jika perlu

            // Update teks dan ukuran garis horizontal (bawah)
            document.getElementById('bottom-text').innerHTML = newHorizontalSize + 'cm';
            // document.getElementById('bottom-line').style.width = (newHorizontalSize * 4.3) + 'px';  // Sesuaikan skala jika perlu

            // Simpan ukuran yang baru
            currentVerticalSize = newVerticalSize;
            currentHorizontalSize = newHorizontalSize;
        }

        // Event listener untuk tombol update ukuran
        // document.getElementById('update-size').addEventListener('click', function() {
        //     updateDimensions();
        // });

        // tidak dipakai karena ini halaman redesain
        // document.getElementById('input-vertical-size').addEventListener('change', function() {
        //     updateDimensions();
        // });
        // document.getElementById('input-horizontal-size').addEventListener('change', function() {
        //     updateDimensions();
        // });


        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai

        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai




        // Variabel untuk menyimpan total harga
        let hargakayu = 0;
        let totalPrice = pembelian.harga_kayu + datapilihan[0].harga + pembelian.harga_finishing;
        updateTotalPrice2();


        // Fungsi untuk memperbarui total harga di UI
        function updateTotalPrice(selectedKayuPrice) {
            hargakayu = parseInt(selectedKayuPrice);
            let finalPrice = totalPrice + parseInt(selectedKayuPrice);
            document.getElementById('total-price').textContent = finalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        function updateTotalPrice2() {
            let finalPrice = totalPrice + hargakayu;
            document.getElementById('total-price').textContent = finalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        // Event listener untuk dropdown jenis kayu
        // tidak dipakai karena ini halaman redesain
        // document.getElementById('jeniskayu').addEventListener('change', function() {
        //     let selectedKayuId = this.value;

        //     // Cari data kayu berdasarkan id di array kayuData
        //     let selectedKayu = kayuData.find(kayu => kayu.id == selectedKayuId);

        //     // Jika data kayu ditemukan, ambil jenis kayu dan harga
        //     if (selectedKayu) {
        //         let selectedKayuType = selectedKayu.jenis_kayu;
        //         let selectedKayuPrice = selectedKayu.harga;

        //         // Perbarui total harga
        //         updateTotalPrice(selectedKayuPrice);

        //         // Contoh log jenis kayu dan harga yang dipilih
        //         console.log("Jenis kayu yang dipilih:", selectedKayuType);
        //         console.log("Harga kayu yang dipilih:", selectedKayuPrice);
        //     }
        // });

        // Fungsi untuk menambahkan add-on
        function updateAddOn(imageURL) {
            if (!imageURL) {
                canvas.clear();
                canvas.renderAll();
            }

            fabric.Image.fromURL(imageURL, function(img) {
                var canvasWidth = canvas.getWidth();
                var canvasHeight = canvas.getHeight();

                var imgWidth = img.width;
                var imgHeight = img.height;

                var scaleX = 1;
                var scaleY = 1;

                if (imageURL.includes('sekatHorizontal')) {
                    // Skala khusus untuk sekat horizontal
                    scaleX = canvasWidth / imgWidth; // Sesuaikan lebar dengan kanvas
                    scaleY = 0.3; // Lebih tipis pada sumbu Y untuk sekat horizontal
                    counterSekatHorizontal++; // Tambah counter sekat horizontal
                    totalPrice += addonPrices.sekatHorizontal;
                    img.setControlsVisibility({
                        mt: false,
                        mb: false,
                        ml: true,
                        mr: true,
                        tl: false,
                        tr: false,
                        bl: false,
                        br: false
                    });
                } else if (imageURL.includes('sekatvertical')) {
                    // Skala khusus untuk sekat vertical
                    scaleX = 0.3; // Lebih tipis pada sumbu X untuk sekat vertical
                    scaleY = canvasHeight / imgHeight; // Sesuaikan tinggi dengan kanvas
                    counterSekatVertical++; // Tambah counter sekat vertical
                    totalPrice += addonPrices.sekatVertical;
                    img.setControlsVisibility({
                        mt: true,
                        mb: true,
                        ml: false,
                        mr: false,
                        tl: false,
                        tr: false,
                        bl: false,
                        br: false
                    });

                } else if (imageURL.includes('gantungan')) {
                    // Skala khusus untuk gantungan
                    scaleX = canvasWidth / imgWidth; // Buat sedikit lebih kecil
                    scaleY = 0.5; // Lebih tipis pada sumbu Y untuk gantungan
                    counterGantungan++; // Tambah counter gantungan
                    totalPrice += addonPrices.gantungan;
                    img.setControlsVisibility({
                        mt: false,
                        mb: false,
                        ml: true,
                        mr: true,
                        tl: false,
                        tr: false,
                        bl: false,
                        br: false
                    });
                } else if (imageURL.includes('lacikecil')) {
                    // Skala khusus untuk gantungan
                    scaleX = canvasWidth / imgWidth; // Buat sedikit lebih kecil
                    scaleY = 0.13; // Lebih tipis pada sumbu Y untuk gantungan
                    counterlaciKecil++; // Tambah counter gantungan
                    totalPrice += addonPrices.laciKecil;
                    img.setControlsVisibility({
                        mt: false,
                        mb: false,
                        ml: true,
                        mr: true,
                        tl: false,
                        tr: false,
                        bl: false,
                        br: false
                    });
                    img.set({
                        stroke: 'black', // Warna border
                        strokeWidth: 6 // Ketebalan border dalam pixel
                    });
                } else if (imageURL.includes('lacibesar')) {
                    // Skala khusus untuk gantungan
                    scaleX = canvasWidth / imgWidth; // Buat sedikit lebih kecil
                    scaleY = 0.2; // Lebih tipis pada sumbu Y untuk gantungan
                    counterlaciBesar++; // Tambah counter gantungan
                    totalPrice += addonPrices.laciBesar;
                    img.setControlsVisibility({
                        mt: false,
                        mb: false,
                        ml: false,
                        mr: false,
                        tl: false,
                        tr: false,
                        bl: false,
                        br: false
                    });
                    img.set({
                        stroke: 'black', // Warna border
                        strokeWidth: 6 // Ketebalan border dalam pixel
                    });
                }

                img.scaleX = scaleX;
                img.scaleY = scaleY;

                updateCounters();
                updateTotalPrice2(); // Perbarui total harga di UI

                img.lockRotation = true;



                img.on('scaling', function(e) {
                    var obj = e.target;

                    if (obj.getScaledWidth() > canvasWidth) {
                        obj.scaleX = canvasWidth / obj.width;
                    }

                    if (obj.getScaledHeight() > canvasHeight) {
                        obj.scaleY = canvasHeight / obj.height;
                    }

                    obj.setCoords();
                    canvas.renderAll();
                });

                canvas.on('object:moving', function(e) {
                    var obj = e.target;
                    var canvasWidth = canvas.getWidth();
                    var canvasHeight = canvas.getHeight();

                    if (obj.left < 0) {
                        obj.left = 0;
                    }
                    if (obj.left + obj.width * obj.scaleX > canvasWidth) {
                        obj.left = canvasWidth - obj.width * obj.scaleX;
                    }

                    if (obj.top < 0) {
                        obj.top = 0;
                    }

                    if (obj.top + obj.height * obj.scaleY > canvasHeight) {
                        obj.top = canvasHeight - obj.height * obj.scaleY;
                    }

                    obj.setCoords();
                    canvas.renderAll();
                });

                // Tambahkan gambar ke kanvas
                canvas.add(img);

                // Event listener untuk mengurangi counter dan total harga saat gambar dihapus
                img.on('removed', function() {
                    if (imageURL.includes('sekatHorizontal')) {
                        counterSekatHorizontal--;
                        totalPrice -= addonPrices.sekatHorizontal; // Kurangi counter sekat horizontal
                    } else if (imageURL.includes('sekatvertical')) {
                        counterSekatVertical--; // Kurangi counter sekat vertical
                        totalPrice -= addonPrices.sekatVertical;
                    } else if (imageURL.includes('gantungan')) {
                        counterGantungan--; // Kurangi counter gantungan
                        totalPrice -= addonPrices.gantungan;
                    } else if (imageURL.includes('lacikecil')) {
                        counterlaciKecil--; // Kurangi counter gantungan
                        totalPrice -= addonPrices.laciKecil;
                    } else if (imageURL.includes('lacibesar')) {
                        counterlaciBesar--; // Kurangi counter gantungan
                        totalPrice -= addonPrices.laciBesar;
                    }
                    updateCounters(); // Perbarui tampilan counter di UI
                    updateTotalPrice2();
                });

                canvas.renderAll();
            });
        }


        // Event listener untuk tombol tambah gambar
        document.getElementById('btntambah').addEventListener('click', function() {
            updateAddOn(document.getElementById('tshirt-design').value);
        }, false);



        // Fungsi untuk menghapus objek ketika tombol DEL ditekan

        document.getElementById('remove').addEventListener('click', function() {
            var object = canvas.getActiveObject();
            if (!object) {
                alert('Pilih Add-On yang ingin dihapus');
                return;
            }
            canvas.remove(object);
            canvas.renderAll();
        });


        document.getElementById('terimaPesanan').addEventListener('click', function() {
            // Get harga and ongkir values
            var hargaLamaInput = document.getElementById('harga-fix');
            var hargaRedesainInput = document.getElementById('harga-redesain');

            var ongkirInput = document.getElementById('ongkir');
            var ongkir = parseInt(ongkirInput.value);
            var lama = parseInt(hargaLamaInput.value);
            var redesain = parseInt(hargaRedesainInput.value);

            // Check if ongkir is filled and valid
            if (!hargaLamaInput.value || isNaN(lama) || lama <= 0) {
                alert("Masukkan Harga Desain Lama yang valid sebelum melanjutkan.");
                hargaLamaInput.focus();
                return;
            }
            if (!hargaRedesainInput.value || isNaN(redesain) || redesain <= 0) {
                alert("Masukkan Harga Redesain yang valid sebelum melanjutkan.");
                hargaRedesainInput.focus();
                return;
            }
            if (!ongkirInput.value || isNaN(ongkir) || ongkir <= 0) {
                alert("Masukkan ongkir yang valid sebelum melanjutkan.");
                ongkirInput.focus();
                return;
            }



            // Calculate total and display in the confirmation modal
            var total1 = lama + ongkir;
            var total2 = redesain + ongkir;
            document.getElementById('totalAmount1').textContent = 'Rp ' + total1.toLocaleString();
            document.getElementById('totalAmount2').textContent = 'Rp ' + total2.toLocaleString();

            // Show the confirmation modal
            var confirmModal = new bootstrap.Modal(document.getElementById('modalConfirmPesanan'));
            confirmModal.show();
        });


        document.getElementById('confirmOrder').addEventListener('click', function(event) {
            // Ambil elemen produk-div
            const form = document.getElementById('redesain-form');

            if (form.checkValidity()) {
                event.preventDefault();
                var element = document.getElementById('produk-div');

                let fixHarga = document.getElementById('harga-fix').value;
                let hargaRedesain = document.getElementById('harga-redesain').value;
                let ongkir = document.getElementById('ongkir').value;

                canvas.getObjects().forEach(function(obj) {
                    if (!obj.gridLine) {
                        obj.set({
                            opacity: 0.6
                        });
                    }

                });
                canvas.renderAll();

                // Gunakan html2canvas untuk membuat screenshot dari elemen
                html2canvas(element).then(function(canvas) {
                    // Ubah canvas menjadi URL gambar base64
                    var dataURL = canvas.toDataURL('image/png');

                    fetch('/seller/kirimRedesain', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                image: dataURL,
                                id_Htrans: pembelian.id,
                                sekatHorizontal: counterSekatHorizontal || 0,
                                sekatVertical: counterSekatVertical || 0,
                                gantungan: counterGantungan || 0,
                                addonPrices: addonPrices,
                                total_harga: totalPrice,
                                hargaFix: fixHarga,
                                hargaRedesain: hargaRedesain,
                                ongkir: ongkir



                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // alert('Perbaikan Desain Berhasil dikirim');
                                window.location.href = '{{ url('/seller/pesanan/detailPesanan') }}' + '/' +
                                    pembelian.id;
                            } else if (data.membership) {
                                alert("daftar membership untuk menerima pesanan lebih dari 5");
                            }
                             else {
                                alert("gambar gagal disimpan");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengirim gambar');
                        })
                        .finally(() => {
                            // Sembunyikan loading screen setelah proses selesai
                            document.getElementById('loadingScreen').style.display = 'none';
                        });

                });
            } else {
                this.reportValidity();
            }



        });
    </script>

@endsection
