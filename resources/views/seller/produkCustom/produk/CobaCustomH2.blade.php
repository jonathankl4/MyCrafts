@extends('template.MasterDesain')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Coba Custom Lemari 1')

@section('style')
    <style>
        .drawing-area {
            position: absolute;
            top: 23px;
            left: 33px;
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
            <h2 class="fw-bold py-3 mb-4">Custom Mebel Halaman 2</h2>

            <div class="row">

                <div class="col-md-7" style="z-index: 3">
                    <div class="card mb-4">
                        <h5 class="card-header">Desain</h5>

                        <div class="card" style="padding: 15px">

                            <div id="produk-div">
                                <!--
                                                                            Initially, the image will have the background tshirt that has transparency
                                                                            So we can simply update the color with CSS or JavaScript dinamically
                                                                        -->
                                {{-- <img id="template" src="{{url("img/bajuhitam.png")}}"/> --}}
                                <img id="template" src="{{ url('img/lemari1/lemari1.png') }}"
                                    style="width: 100%;height: 100%;" />

                                <div id="drawingArea" class="drawing-area">
                                    <div class="canvas-container" style="position: relative">
                                        <canvas id="tshirt-canvas" width="390px" height="480"
                                            style="border-style: solid; border-width: 2px"></canvas>

                                        <div id="right-line"
                                            style="position: absolute; right: -240px; top: -20px; height:550px; width: 2px; background-color: black;">
                                        </div>
                                        <div id="right-text"
                                            style="position: absolute; right: -320px; top: 50%; transform: translateY(-50%); font-size: 20px;">
                                            150cm</div>

                                        <!-- Garis horizontal di bawah untuk 70cm -->
                                        <div id="bottom-line"
                                            style="position: absolute; left: -20px; bottom: -130px; width: 430px; height: 2px; background-color: black;">
                                        </div>
                                        <div id="bottom-text"
                                            style="position: absolute; left: 50%; bottom: -160px; transform: translateX(-50%); font-size: 20px;">
                                            70cm</div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 40px">

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-5" style="z-index: 3;">
                    <div class="card mb-6">
                        <h5 class="card-header"><b>Kustomisasi</b></h5>
                        <div style="padding: 15px">

                            <div >
                                <label for="pintu-design">Pilih Pintu lemari</label>
                                <select id="pintu-design" class="form-select">
                                    <option value="" selected disabled>pilih.</option>
                                    <option value="tanpaPintu" data-price="0">tanpa pintu</option>

                                    @for ($i = 0; $i < count($listPintu); $i++)
                                        <option value="{{ url($listPintu[$i]->url) }}"
                                            data-price="{{ $listPintu[$i]->harga }}"> {{ $listPintu[$i]->nama_addon }} - (Rp.{{ number_format($listPintu[$i]->harga) }})
                                        </option>
                                    @endfor



                                </select>
                                <br>
                                <div>

                                    <label for="detail">Catatan untuk Penjual</label>
                                    <br>
                                    <textarea name="detail" id="" cols="30" rows="5" placeholder=""></textarea>
                                    <br>
                                    <span class="badge bg-info" style="font-size: 16px">Perkiraan Harga: <span
                                            id="totalHarga"></span></span>
                                </div>
                                <br>
                                <button id="btn-beli" class="btn btn-success">Beli</button>

                            </div>
                            <br>



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
            });
        }




        // Event listener untuk tombol tambah gambar
        // document.getElementById('btntambah').addEventListener('click', function() {
        //     updateAddOn(document.getElementById('tshirt-design').value);
        // }, false);

        document.getElementById('pintu-design').addEventListener('change', function() {
            updatePintu(document.getElementById('pintu-design').value);
        }, false);



        document.getElementById('btn-beli').addEventListener('click', function() {
            // Ambil elemen produk-div
            var element = document.getElementById('produk-div');

            // Gunakan html2canvas untuk membuat screenshot dari elemen
            html2canvas(element).then(function(canvas) {
                // Ubah canvas menjadi URL gambar base64
                var dataURL = canvas.toDataURL('image/png');

                fetch('/seller/save-image', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            image: dataURL
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('GAmbar berhasil disimpan');
                        } else {
                            alert("gambar gagal disimpan");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim gambar');
                    });


                // ini untuk save foto ke download
                // Buat elemen link sementara
                // var link = document.createElement('a');
                // link.href = dataURL;

                // Set nama file untuk download
                // link.download = 'produk-div-image.png';

                // Trigger klik untuk download gambar
                // link.click();
            });
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

            let hargaPintu = @json($addonPrices);
            console.log(hargaPintu);
            let currentPintuPrice = 0;


            function updateTotalHarga() {
                let finalTotal = totalHarga + currentPintuPrice;
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
                document.getElementById('bottom-text').innerHTML = ukuranData.panjang + 'cm';
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
                            lockRotation: true // Cegah rotasi objek
                        });
                    });
                    // Render ulang setelah load
                    canvas.renderAll();
                });
            }
        });
    </script>

@endsection
