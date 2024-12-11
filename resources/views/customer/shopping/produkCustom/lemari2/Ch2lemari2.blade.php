@extends('template.shoppingTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Coba Custom Lemari 1')

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
            <h2 class="fw-bold py-3 mb-4">Custom Mebel Halaman 2</h2>
            <button onclick="history.back()" class="btn btn-secondary">Kembali ke halaman 1</button>
            <div class="row">

                <div class="col-md-6" style="overflow: auto; z-index: 3;">
                    <div class="card">
                        <h5 class="card-header">Desain</h5>



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
                                        <canvas id="tshirt-canvas" width="355px" height="590px"
                                            style="border-style: solid; border-width: 2px"></canvas>

                                        <div id="right-line"
                                            style="position: absolute; right: -210px; top: -20px; height:630px; width: 2px; background-color: black;">
                                        </div>
                                        <div id="right-text"
                                            style="position: absolute; right: -290px; top: 80%; transform: translateY(-50%); font-size: 20px;">
                                            cm</div>

                                        <!-- Garis horizontal di bawah untuk 70cm -->
                                        <div id="bottom-line"
                                            style="position: absolute; left: -40px; bottom: -230px; width: 430px; height: 2px; background-color: black;">
                                        </div>
                                        <div id="bottom-text"
                                            style="position: absolute; left: 70%; bottom: -260px; transform: translateX(-50%); font-size: 20px;">
                                            cm</div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 40px">

                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-md-6" style="z-index: 3">
                    <form id="customForm">
                        <div class="card mb-4">
                            <h5 class="card-header"><b>Kustomisasi</b></h5>
                            <div style="padding: 15px; color: black">

                                <div class="mb-3">
                                    <label for="pintu-design" class="form-label">Pilih Pintu Lemari</label>
                                    <select id="pintu-design" class="form-select" required>
                                        <option value="" selected disabled>pilih.</option>
                                        <option value="" data-price="0" data-nama="Tanpa Pintu">Tanpa Pintu</option>

                                        @for ($i = 0; $i < count($listPintu); $i++)
                                            <option value="{{ url($listPintu[$i]->url) }}"
                                                data-price="{{ $listPintu[$i]->harga }}"
                                                data-nama="{{ $listPintu[$i]->nama_addon }}">
                                                {{ $listPintu[$i]->nama_addon }} -
                                                (Rp.{{ number_format($listPintu[$i]->harga) }})
                                            </option>
                                        @endfor
                                    </select>
                                    <div id="divslider" style="display: none">

                                        <label for="opacitySlider" class="form-label">Opacity</label>
                                        <input type="range" id="opacitySlider" min="0.1" max="1" step="0.01"
                                            value="1" onchange="updateOpacity(this.value)" >
                                    </div>


                                </div>
                                <div class="mb-3">
                                    <label for="finishing" class="form-label">Pilih Finishing</label>
                                    <select id="finishing" class="form-select" required>
                                        <option value="" selected disabled>pilih.</option>


                                        @for ($i = 0; $i < count($listFinishing); $i++)
                                            <option value="{{ url($listFinishing[$i]->fdId) }}"
                                                data-price="{{ $listFinishing[$i]->harga }}"
                                                data-nama="{{ $listFinishing[$i]->nama_finishing }}">
                                                {{ $listFinishing[$i]->nama_finishing }} -
                                                (Rp.{{ number_format($listFinishing[$i]->harga) }})
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <span class="badge bg-info" style="font-size: 16px;">Perkiraan Harga: <span
                                            id="totalHarga">Rp 0</span></span>
                                    <br><br>
                                    <div class="alert alert-warning text-dark">
                                        <ul class="list-unstyled">

                                            <li class="mb-2" id="ukuran-tinggi">
                                                •
                                                Tinggi: 160cm -180 cm
                                            </li>
                                            <li class="mb-2" id="ukuran-lebar">
                                                •
                                                Lebar: 80cm - 100cm
                                            </li>
                                            <li class="mb-2" id="ukuran-kedalaman">
                                                •
                                                Tebal (Kedalaman): 45cm - 60cm
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <label for="detail">Penjelasan Customisasi</label>
                                    <br>
                                    <textarea name="detail" id="detail" cols="30" rows="5"
                                        placeholder="Tolong berikan detail kustomisasi anda" class="form-control"></textarea>
                                    <br>

                                </div>


                                <br>
                                <div id="total-price-container">


                                    <button id="btn-beli" class="btn btn-success w-100"><i class="fas fa-arrow-right me-2"></i>Selanjutnya</button>
                                    
                                </div>

                            </div>
                            <br>



                        </div>



                </div>
                </form>
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
        let tempgrid = null;


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

        let totalHarga = 0;

        function updateOpacity(value) {
            if (currentDoor) { // pastikan `currentDoor` ada
                currentDoor.set({
                    opacity: parseFloat(value)
                });
                canvas.renderAll();
            }

        }





        function checkCurrentDoor() {
            const opacitySlider = document.getElementById("divslider");

            if (currentDoor) {
                opacitySlider.style.display = "block"; // Tampilkan slider jika currentDoor terisi
            } else {
                opacitySlider.style.display = "none"; // Sembunyikan slider jika currentDoor kosong
            }
        }



        // Fungsi untuk memperbarui counter di UI
        function updateCounters() {
            document.getElementById('count-sekat-horizontal').textContent = counterSekatHorizontal;
            document.getElementById('count-sekat-vertical').textContent = counterSekatVertical;
            document.getElementById('count-gantungan').textContent = counterGantungan;
        }

        let currentVerticalSize = 150;
        let currentHorizontalSize = 70;

        // Fungsi untuk mengupdate garis dan teks


        // Event listener untuk tombol update ukuran
        // document.getElementById('update-size').addEventListener('click', function() {
        //     updateDimensions();
        // });


        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai
        function updatePintu(imageURL) {


            if (currentDoor !== null) {
                canvas.remove(currentDoor);
                currentDoor = null;
            }

            // jika memilih tanpa pintu maka akan menjalankan perintah dibawah ini sehingga tidak ada pintu baru yang ditambah
            if (!imageURL || imageURL === "") {
                checkCurrentDoor();
                return;
            }

            fabric.Image.fromURL(imageURL, function(img) {
                var canvasWidth = canvas.getWidth();
                var canvasHeight = canvas.getHeight();

                var imgWidth = img.width;
                var imgHeight = img.height;


                if (imageURL.includes('pintu1')) {
                    scaleX = canvasWidth / imgWidth;
                    scaleY = canvasHeight / imgHeight;
                } else if (imageURL.includes('pintu2')) {
                    scaleX = canvasWidth / imgWidth;
                    scaleY = canvasHeight / imgHeight;
                } else if (imageURL.includes('pintugeser')) {
                    scaleX = canvasWidth / imgWidth;
                    scaleY = canvasHeight / imgHeight;
                }

                img.scaleX = scaleX;
                img.scaleY = scaleY;
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

                canvas.add(img);
                currentDoor = img;
                canvas.renderAll();
                checkCurrentDoor();
            });
        }




        // Event listener untuk tombol tambah gambar
        // document.getElementById('btntambah').addEventListener('click', function() {
        //     updateAddOn(document.getElementById('tshirt-design').value);
        // }, false);

        document.getElementById('pintu-design').addEventListener('change', function() {
            updatePintu(document.getElementById('pintu-design').value);
        }, false);



        document.getElementById('customForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            // Cek apakah form valid
            if (this.checkValidity()) {
                // Ambil elemen produk-div
                var element = document.getElementById('produk-div');

                // Ambil pilihan pintu dan harga pintu
                var selectedPintu = document.getElementById('pintu-design').value;
                var selectedPintuName = document.getElementById('pintu-design').options[document
                    .getElementById('pintu-design').selectedIndex].getAttribute('data-nama');
                var selectedPintuPrice = parseInt(document.getElementById('pintu-design').options[document
                    .getElementById('pintu-design').selectedIndex].getAttribute('data-price'));

                var selectedFinishingName = document.getElementById('finishing').options[document
                    .getElementById('finishing').selectedIndex].getAttribute('data-nama');
                var selectedFinishingPrice = parseInt(document.getElementById('finishing').options[document
                    .getElementById('finishing').selectedIndex].getAttribute('data-price'));
                const addonData = JSON.parse(localStorage.getItem('addonData'));
                const addonPrices = JSON.parse(localStorage.getItem('addonPrices'));

                let catatan = document.getElementById('detail').value;

                updateOpacity(1);
                // Gunakan html2canvas untuk membuat screenshot dari elemen
                html2canvas(element).then(function(canvas) {
                    // Ubah canvas menjadi URL gambar base64
                    var dataURL = canvas.toDataURL('image/png');

                    fetch('/save2', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                image: dataURL,
                                total_harga: totalHarga + selectedPintuPrice +
                                    selectedFinishingPrice,
                                status: 0,
                                pintu: selectedPintuName,
                                pintuPrice: selectedPintuPrice,
                                sekatHorizontal: addonData.sekatHorizontal ||
                                    0, // Kirim add-on sekat horizontal
                                sekatVertical: addonData.sekatVertical ||
                                    0, // Kirim add-on sekat vertical
                                gantungan: addonData.gantungan || 0, // Kirim add-on gantungan
                                laciKecil: addonData.laciKecil || 0, // Kirim add-on gantungan
                                laciBesar: addonData.laciBesar || 0, // Kirim add-on gantungan
                                addonPrices: addonPrices,
                                catatan: catatan,

                                finishing: selectedFinishingName,
                                harga_finishing: selectedFinishingPrice
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = "{{ url('/customer/checkoutCustom') }}";

                            } else {
                                alert("Gambar gagal disimpan");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengirim gambar');
                        });
                });
            } else {
                // Tampilkan pesan validasi form bawaan browser
                this.reportValidity();
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            // let canvas = new fabric.Canvas('tshirt-canvas');

            // Periksa apakah ada data desain yang tersimpan di localStorage
            const savedDesign = localStorage.getItem('canvasDesign');

            const canvasDesign = localStorage.getItem('canvasDesign');
            const addonData = JSON.parse(localStorage.getItem('addonData'));
            const ukuranData = JSON.parse(localStorage.getItem('ukuranData'));
            const totalPrice = localStorage.getItem('totalPrice');
            totalHarga = parseInt(totalPrice);
            tempgrid = JSON.parse(localStorage.getItem('tempgrid'));
            let hargaPintu = @json($addonPrices);
            console.log(hargaPintu);
            let currentPintuPrice = 0;
            let currentFinishingPrice = 0;

            document.getElementById('ukuran-tinggi').textContent = '• Tinggi: ' + ukuranData.tinggi + ' cm';
            document.getElementById('ukuran-lebar').textContent = '• Lebar: ' + ukuranData.lebar + ' cm';
            document.getElementById('ukuran-kedalaman').textContent = '• Tebal (kedalaman): ' + ukuranData
                .kedalaman + ' cm';



            function updateTotalHarga() {
                let finalTotal = totalHarga + currentPintuPrice + currentFinishingPrice;
                document.getElementById('totalHarga').textContent = finalTotal.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
            }
            document.getElementById('pintu-design').addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                let selectedPintuPrice = parseInt(selectedOption.getAttribute('data-price'));

                // Periksa apakah harga ada
                if (!isNaN(selectedPintuPrice)) {
                    currentPintuPrice = selectedPintuPrice;
                } else {
                    currentPintuPrice = 0; // default jika tidak ada pintu
                }

                // Update total harga di UI
                updateTotalHarga();
            }, false);
            document.getElementById('finishing').addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                let selectedFinishingPrice = parseInt(selectedOption.getAttribute('data-price'));

                // Periksa apakah harga ada
                if (!isNaN(selectedFinishingPrice)) {
                    currentFinishingPrice = selectedFinishingPrice;
                } else {
                    currentFinishingPrice = 0; // default jika tidak ada pintu
                }

                // Update total harga di UI
                updateTotalHarga();
            }, false);
            // Cek apakah data ada
            if (canvasDesign && addonData && ukuranData && totalPrice) {
                console.log('Canvas Design:', JSON.parse(canvasDesign));
                console.log('Addon Data:', addonData);
                console.log('Ukuran Data:', ukuranData);
                console.log('Total Harga:', totalPrice + ' IDR');

                // Contoh menampilkan data di halaman

                document.getElementById('totalHarga').textContent = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });

                document.getElementById('right-text').innerHTML = ukuranData.tinggi + 'cm';
                document.getElementById('bottom-text').innerHTML = ukuranData.lebar + 'cm';
            } else {
                console.error('Data tidak tersedia di localStorage');
            }
            if (canvasDesign) {
                // Jika ada, konversi kembali JSON ke format object fabric
                canvas.loadFromJSON(canvasDesign, function() {


                    canvas.getObjects().forEach(function(obj) {
                        obj.set({
                            selectable: false, // Nonaktifkan agar objek tidak bisa dipilih
                            evented: false, // Nonaktifkan semua event klik dan interaksi
                            lockMovementX: true, // Cegah gerakan ke sumbu X
                            lockMovementY: true, // Cegah gerakan ke sumbu Y
                            lockScalingX: true, // Cegah pengubahan ukuran pada sumbu X
                            lockScalingY: true, // Cegah pengubahan ukuran pada sumbu Y
                            lockRotation: true, // Cegah rotasi objek

                        });
                    });
                    // Render ulang setelah load
                    canvas.renderAll();


                });
            }
        });
    </script>

@endsection
