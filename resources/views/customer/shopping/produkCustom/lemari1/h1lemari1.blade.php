@extends('template.shoppingTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Custom Lemari 1')

@section('style')
    <style>
        :root {
            --primary-color: #2d3436;
            --secondary-color: #636e72;
            --accent-color: #0984e3;
            --background-color: #f5f6fa;
            --border-radius: 12px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--background-color);
        }

        .customization-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }

        .card-header {
            background: white;
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .card-header h5 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .card-content {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(9, 132, 227, 0.1);
        }

        .size-input {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .addon-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
        }

        .btn-primary:hover {
            background: #0873c4;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        #total-price-container {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin-top: 2rem;
            box-shadow: var(--box-shadow);
        }

        #total-price-container h5 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .price-note {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .drawing-area {
            position: absolute;
            top: 20px;
            left: 31px;
            z-index: 10;
            width: 200px;
            height: 30px;
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
            height: 548px;
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

        #right-line {
            position: absolute;
            right: -60px;
            /* Buat garis berada di luar kanvas */
            top: 20px;
            height: 370px;
            /* Sesuaikan tinggi */
            width: 2px;
            background-color: black;

        }


        #right-text {
            position: absolute;
            right: -90px;
            /* Buat teks ukuran berada di luar kanvas */
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        #bottom-line {
            position: absolute;
            left: 20px;
            bottom: -40px;
            /* Buat garis berada di luar kanvas */
            width: 320px;
            /* Sesuaikan lebar */
            height: 2px;
            background-color: black;
        }

        #bottom-text {
            position: absolute;
            left: 50%;
            bottom: -60px;
            /* Buat teks ukuran berada di luar kanvas */
            transform: translateX(-50%);
            font-size: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <br><br><br><br><br><br><br>
        <div class="flex-grow-1 container-p-y" style="width: 100% ; padding: 10px">
            <h2 class="fw-bold py-3 mb-4">Custom Lemari No 1</h2>
            <div class="row">
                <div class="col-md-6" style="overflow: auto; z-index: 3;">
                    <div class="card">
                        <h5 class="card-header"><b>Desain</b></h5>
                        <div style="padding: 15px">
                            <div id="produk-div">
                                <img id="template" src="{{ url('img/lemari1/lemari1.png') }}"
                                    style="width: 100%;height: 100%;" />

                                <div id="drawingArea" class="drawing-area">
                                    <div class="canvas-container" style="position: relative">
                                        <canvas id="tshirt-canvas" width="390px" height="480"
                                            style="border-style: solid; border-width: 2px; border-color: white"></canvas>

                                        <div id="right-line"
                                            style="position: absolute; right: -230px; top: -20px; height:550px; width: 2px; background-color: black;">
                                        </div>
                                        <div id="right-text"
                                            style="position: absolute; right: -300px; top: 50%; transform: translateY(-50%); font-size: 20px;">
                                            {{ $produk->tinggi_min }}cm</div>

                                        <!-- Garis horizontal di bawah untuk 70cm -->
                                        <div id="bottom-line"
                                            style="position: absolute; left: -20px; bottom: -130px; width: 430px; height: 2px; background-color: black;">
                                        </div>
                                        <div id="bottom-text"
                                            style="position: absolute; left: 50%; bottom: -160px; transform: translateX(-50%); font-size: 20px;">
                                            {{ $produk->lebar_min }}cm</div>

                                    </div>
                                </div>
                            </div>
                            <div style="height: 40px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="z-index: 3">
                    <div class="customization-card">
                        <div class="card-header">
                            <h5><i class="fas fa-sliders-h me-2"></i>Customisasi</h5>
                        </div>
                        <div class="card-content">
                            <div class="form-group">
                                <label class="form-label" for="jeniskayu">Jenis Kayu</label>
                                <select id="jeniskayu" class="form-select">
                                    <option value="" selected disabled>Pilih Jenis Kayu</option>
                                    @if (count($detail) < 1)
                                        <option value="" disabled>tidak tersedia pilihan</option>
                                    @endif
                                    @foreach ($detail as $wood)
                                        <option value="{{ $wood->id }}">
                                            {{ $wood->jenis_kayu }} (Rp.{{ number_format($wood->harga) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="size-input">
                                <span style="color: red">ukuran garis bantu(grid) adalah 10x10 cm per kotak</span>
                                <div class="form-group">
                                    <label class="form-label" for="input-vertical-size">
                                        Tinggi ({{ $produk->tinggi_min }} - {{ $produk->tinggi_max }} cm)
                                    </label>
                                    <input type="number" id="input-vertical-size" class="form-control"
                                        value="{{ $produk->tinggi_min }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="input-horizontal-size">
                                        Lebar ({{ $produk->lebar_min }} - {{ $produk->lebar_max }} cm)
                                    </label>
                                    <input type="number" id="input-horizontal-size" class="form-control"
                                        value="{{ $produk->lebar_min }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="input-kedalaman-size">
                                        Tebal (Kedalaman) ({{ $produk->panjang_min }} - {{ $produk->panjang_max }} cm)
                                    </label>
                                    <input type="number" id="input-kedalaman-size" class="form-control"
                                        value="{{ $produk->panjang_min }}">
                                </div>
                            </div>

                            <div class="addon-section">
                                <label class="form-label" for="tshirt-design">
                                    <i class="fas fa-plus-circle me-2"></i>Add-ons
                                </label>
                                <span></span>
                                <select id="tshirt-design" class="form-select mb-3">
                                    <option value="">Select add-on...</option>
                                    @foreach ($listAddOnMain as $addon)
                                        <option value="{{ url($addon->url) }}">
                                            {{ $addon->nama_addon }} (Rp.{{ number_format($addon->harga) }})
                                        </option>
                                    @endforeach
                                </select>
                                <span>Opacity</span>
                                <input type="range" id="opacitySlider" min="0.1" max="1" step="0.01"
                                        value="1" onchange="updateOpacity(this.value)" >
                                <div id="counters">
                                    <div style="display: none">Jumlah Sekat Horizontal: <span
                                            id="count-sekat-horizontal">0</span></div>
                                    <div style="display:none">Jumlah Sekat Vertical: <span
                                            id="count-sekat-vertical">0</span>

                                    </div>
                                    <div style="display: none">Jumlah Gantungan: <span id="count-gantungan">0</span></div>
                                    <div style="display: none">Jumlah laci kecil: <span id="count-laci-kecil">0</span></div>
                                    <div style="display: none">Jumlah laci besar: <span id="count-laci-besar">0</span></div>
                                </div>

                                <div class="action-buttons">
                                    <button id="btntambah" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah
                                    </button>
                                    <button id="remove" class="btn btn-danger">
                                        <i class="fas fa-trash me-2"></i>hapus
                                    </button>
                                </div>
                            </div>

                            <div id="total-price-container">
                                <h5>Perkiraan Harga: <span id="total-price">Rp 0</span></h5>
                                <p class="price-note">*Harga Fix akan dikirimkan setelah pembelian di submit</p>
                                <a href="#" id="next-page" class="btn btn-primary w-100">
                                    <i class="fas fa-arrow-right me-2"></i>Selanjutnya
                                </a>
                            </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
        let listadd =[];

        let kayuData = @json($detail);
        let addonPrices = @json($addonPrices);
        console.log(jeniskayu);
        console.log(addonPrices);
        let produk = @json($produk);
        console.log(produk);
        let user = @json($user);

        function updateGrid(canvas, widthCm, heightCm) {
            // Clear existing grid
            canvas.getObjects().forEach(obj => {
                if (obj.gridLine) {
                    canvas.remove(obj);
                }
            });

            const canvasWidth = canvas.getWidth();
            const canvasHeight = canvas.getHeight();
            widthCm -= 4;
            heightCm -= 15;
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
            canvas.getObjects().forEach(function(obj){
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

        let currentVerticalSize = produk.tinggi_min;
        let currentHorizontalSize = produk.lebar_min;
        let currentKedalamanSize = produk.panjang_min;

        let selectedKayuPrice = 0;

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        // Fungsi untuk mengupdate garis dan teks
        function updateDimensions() {
            // Define min and max values
            const minVerticalSize = produk.tinggi_min; // Example minimum value for vertical size
            const maxVerticalSize = produk.tinggi_max; // Example maximum value for vertical size

            const minHorizontalSize = produk.lebar_min; // Example minimum value for horizontal size
            const maxHorizontalSize = produk.lebar_max; // Example maximum value for horizontal size

            const minKedalamanSize = produk.panjang_min; // Example minimum value for horizontal size
            const maxKedalamanSize = produk.panjang_max; // Example maximum value for horizontal size

            // Get new values from inputs
            let newVerticalSize = parseInt(document.getElementById('input-vertical-size').value);
            let newHorizontalSize = parseInt(document.getElementById('input-horizontal-size').value);
            let newKedalamanSize = parseInt(document.getElementById('input-kedalaman-size').value);
            // Validate vertical size
            if (newVerticalSize < minVerticalSize || newVerticalSize > maxVerticalSize) {
                Toast.fire({
                    icon: "error",
                    title: `Ukuran vertikal harus antara ${minVerticalSize}cm dan ${maxVerticalSize}cm.`
                });
                return; // Exit the function if validation fails
            }

            // Validate horizontal size
            if (newHorizontalSize < minHorizontalSize || newHorizontalSize > maxHorizontalSize) {
                Toast.fire({
                    icon: "error",
                    title: `Ukuran horizontal harus antara ${minHorizontalSize}cm dan ${maxHorizontalSize}cm.`
                });
                return; // Exit the function if validation fails
            }
            if (newKedalamanSize < minKedalamanSize || newKedalamanSize > maxKedalamanSize) {
                Toast.fire({
                    icon: "error",
                    title: `Ukuran Tebal (kedalaman) harus antara ${minKedalamanSize}cm dan ${maxKedalamanSize}cm.`
                });
                return; // Exit the function if validation fails
            }

            // Update text and size for vertical line (right)
            document.getElementById('right-text').innerHTML = newVerticalSize + 'cm';
            // document.getElementById('right-line').style.height = (newVerticalSize * 3.67) + 'px';  // Adjust scale if needed

            // Update text and size for horizontal line (bottom)
            document.getElementById('bottom-text').innerHTML = newHorizontalSize + 'cm';
            // document.getElementById('bottom-line').style.width = (newHorizontalSize * 4.3) + 'px';  // Adjust scale if needed

            // Save the new sizes
            currentVerticalSize = newVerticalSize;
            currentHorizontalSize = newHorizontalSize;
            currentKedalamanSize = newKedalamanSize;

            // Show success message
            Toast.fire({
                icon: "success",
                title: "Ukuran berhasil diperbarui!"
            });
        }
        const initialWidth = parseInt(document.getElementById('input-horizontal-size').value);
        const initialHeight = parseInt(document.getElementById('input-vertical-size').value);
        updateGrid(canvas, initialWidth, initialHeight);

        document.getElementById('input-vertical-size').addEventListener('change', function() {
            updateDimensions(); // Memperbarui dimensi teks atau elemen lain jika diperlukan
            const heightCm = parseInt(this.value); // Ini adalah input untuk tinggi
            const widthCm = parseInt(document.getElementById('input-horizontal-size')
                .value); // Ini mengambil nilai lebar
            updateGrid(canvas, widthCm, heightCm); // Panggil fungsi updateGrid dengan lebar dan tinggi yang benar
        });

        document.getElementById('input-horizontal-size').addEventListener('change', function() {
            updateDimensions(); // Memperbarui dimensi teks atau elemen lain jika diperlukan
            const widthCm = parseInt(this.value); // Ini adalah input untuk lebar/lebar
            const heightCm = parseInt(document.getElementById('input-vertical-size')
                .value); // Ini mengambil nilai tinggi
            updateGrid(canvas, widthCm, heightCm); // Panggil fungsi updateGrid dengan lebar dan tinggi yang benar
        });

        document.getElementById('input-kedalaman-size').addEventListener('change', function(){
            updateDimensions();
        });

        // Variabel untuk menyimpan total harga
        let hargakayu = 0;
        let totalPrice = 0;
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
        document.getElementById('jeniskayu').addEventListener('change', function() {
            let selectedKayuId = this.value;

            // Cari data kayu berdasarkan id di array kayuData
            let selectedKayu = kayuData.find(kayu => kayu.id == selectedKayuId);

            // Jika data kayu ditemukan, ambil jenis kayu dan harga
            if (selectedKayu) {
                let selectedKayuType = selectedKayu.jenis_kayu;
                let selectedKayuPrice = selectedKayu.harga;

                // Perbarui total harga
                updateTotalPrice(selectedKayuPrice);

                // Contoh log jenis kayu dan harga yang dipilih
                console.log("Jenis kayu yang dipilih:", selectedKayuType);
                console.log("Harga kayu yang dipilih:", selectedKayuPrice);
            }
        });

        // Fungsi untuk menambahkan add-on
        function updateAddOn(imageURL) {
            if (!imageURL) {
                // canvas.clear();
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
                    scaleX = canvasWidth / imgWidth / 2; // Sesuaikan lebar dengan kanvas
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
                    scaleY = canvasHeight / imgHeight /2; // Sesuaikan tinggi dengan kanvas
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
                    scaleX = canvasWidth / imgWidth / 2; // Buat sedikit lebih kecil
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
                    scaleX = canvasWidth / imgWidth/ 2; // Buat sedikit lebih kecil
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

                img.selectionColor = 'red';
                    img.cornerColor = 'red';

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
                listadd.push(img);

                // Event listener untuk mengurangi counter dan total harga saat gambar dihapus
                img.on('removed', function() {
                    if (imageURL.includes('sekatHorizontal')) {
                        counterSekatHorizontal--;
                        totalPrice -= addonPrices.sekatHorizontal; // Kurangi harga sekatHorizontal
                    } else if (imageURL.includes('sekatvertical')) {
                        counterSekatVertical--;
                        totalPrice -= addonPrices.sekatVertical; // Kurangi harga sekatVertical
                    } else if (imageURL.includes('gantungan')) {
                        counterGantungan--;
                        totalPrice -= addonPrices.gantungan; // Kurangi harga gantungan
                    } else if (imageURL.includes('lacikecil')) {
                        counterlaciKecil--; // Kurangi counter gantungan
                        totalPrice -= addonPrices.laciKecil;
                    } else if (imageURL.includes('lacibesar')) {
                        counterlaciBesar--; // Kurangi counter gantungan
                        totalPrice -= addonPrices.laciBesar;
                    }
                    updateCounters();
                    updateTotalPrice2(); // Perbarui total harga di UI
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

        document.getElementById('next-page').addEventListener('click', function() {



            if (user.role == 'guest') {
                // Tampilkan modal BelumLogin jika user adalah guest
                var myModal = new bootstrap.Modal(document.getElementById('modalBelomLogin'));
                myModal.show();
                return; // Berhenti di sini agar halaman tidak redirect
            }

            let selectedKayuId = document.getElementById('jeniskayu').value;



            // Pengecekan apakah jenis kayu sudah dipilih
            if (!selectedKayuId) {
                alert('Jenis Kayu belum di pilih.');
                return; // Berhenti dan tidak melanjutkan ke halaman berikutnya
            }

            let selectedKayu = kayuData.find(kayu => kayu.id == selectedKayuId);

            let selectedKayuType = selectedKayu.jenis_kayu;
            let selectedKayuPrice = selectedKayu.harga;

            // Perbarui total harga
            const pilihankayu = {
                jenis_kayu: selectedKayuType,
                harga: selectedKayuPrice
            }
            localStorage.setItem('pilihanKayu', JSON.stringify(pilihankayu));

            canvas.getObjects().forEach(function(obj){
                obj.set({
                    opacity: 0.65
                })
            })
            canvas.renderAll();

            // Ambil data dari canvas dalam format JSON
            const canvasDesign = canvas.toJSON();

            // Simpan JSON ke localStorage untuk digunakan di halaman kedua
            localStorage.setItem('canvasDesign', JSON.stringify(canvasDesign));

            const addonData = {
                sekatHorizontal: counterSekatHorizontal,
                sekatVertical: counterSekatVertical,
                gantungan: counterGantungan,
                laciKecil: counterlaciKecil,
                laciBesar: counterlaciBesar
            };
            localStorage.setItem('addonData', JSON.stringify(addonData));

            // Simpan data ukuran
            const ukuranData = {
                tinggi: currentVerticalSize,
                lebar: currentHorizontalSize,
                kedalaman: currentKedalamanSize
            };
            localStorage.setItem('ukuranData', JSON.stringify(ukuranData));

            // Simpan total harga
            localStorage.setItem('totalPrice', totalPrice + hargakayu);

            localStorage.setItem('addonPrices', JSON.stringify(addonPrices));



            // Ambil elemen produk-div
            var element = document.getElementById('produk-div');

            // Gunakan html2canvas untuk membuat screenshot dari elemen
            html2canvas(element).then(function(canvas) {
                // Ubah canvas menjadi URL gambar base64
                var dataURL = canvas.toDataURL('image/png');
                document.getElementById('loadingScreen').style.display = 'block';
                fetch('/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            image: dataURL,
                            id_toko: produk.id_toko,
                            id_user: user.id,
                            nama_produk: produk.nama_produk,
                            jumlah: 1,
                            tipe_trans: 'custom',
                            status: 0,
                            lebar: currentHorizontalSize,
                            tinggi: currentVerticalSize,
                            panjang: currentKedalamanSize, // kedalaman (tebal)

                            jenis_kayu: selectedKayuType,
                            harga_kayu: selectedKayuPrice,
                            id_produk: produk.id

                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // alert('GAmbar berhasil disimpan');
                            window.location.href = "{{ url('/customh2/h2lemari1') }}" + '/' + produk
                                .id;

                        } else {
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
            // Redirect ke halaman kedua
        });
    </script>

@endsection
