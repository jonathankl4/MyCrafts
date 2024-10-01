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
            <h2 class="fw-bold py-3 mb-4">Custom Mebel</h2>

            <div class="row">

                <div class="col-md-7">
                    <div class="card mb-4" style="padding: 15px">
                        <h5 class="card-header">Desain</h5>



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
                <div class="col-md-5">
                    <div class="card mb-4">
                        <h5 class="card-header"><b>Kustomisasi</b></h5>
                        <div style="padding: 15px">
                            <div class="col-md-6">

                                <div>
                                    <label for="jeniskayu">Jenis Kayu</label>
                                    <select name="" id="jeniskayu" class="form-select">
                                        @for ($i = 0; $i < count($detail); $i++)
                                            <option value="{{ $detail[$i]->id }}"> {{ $detail[$i]->jenis_kayu }} (
                                                Rp.{{ number_format($detail[$i]->harga) }} )</option>
                                        @endfor
                                        {{-- <option value="">Mahoni</option>
                                        <option value="">Pinus</option>
                                        <option value="">Sungkai</option> --}}
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
                                <button id="update-size" class="btn btn-primary">Update Ukuran</button>

                            </div>

                            <div id="counters">
                                <div>Jumlah Sekat Horizontal: <span id="count-sekat-horizontal">0</span></div>
                                <div>Jumlah Sekat Vertical: <span id="count-sekat-vertical">0</span></div>
                                <div>Jumlah Gantungan: <span id="count-gantungan">0</span></div>
                            </div>
                            <div class="col-md-6">
                                <label for="tshirt-design"><b> Add On</b></label>
                                <select id="tshirt-design" class="form-select">
                                    <option value="">pilih...</option>

                                    <option value="{{ url('img/sekatHorizontal.jpeg') }}">sekat horizontal</option>
                                    <option value="{{ url('img/sekatvertical.jpeg') }}">sekat vertical </option>
                                    <option value="{{ url('img/gantungan.jpeg') }}">gantungan</option>



                                </select>
                                <br>
                                <button id="btntambah" class="btn btn-primary">tambah</button>

                                <button id="remove" class="btn btn-danger">delete</button>
                                <button id="saveDiv" class="btn btn-success">Save AddOn</button>
                            </div>
                            <br><br>
                            <div id="total-price-container">
                                <h5>Total Harga: <span id="total-price">0</span> IDR</h5>
                            </div>

                            {{-- <button id="btn-beli" class="btn btn-success">Next</button> --}}
                            {{-- <a href="#" id="next-page" class="btn btn-primary">Next</a> --}}
                            <a href="#" id="next-page" class="btn btn-primary">Next</a>

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

        // Fungsi untuk memperbarui counter di UI
        function updateCounters() {
            document.getElementById('count-sekat-horizontal').textContent = counterSekatHorizontal;
            document.getElementById('count-sekat-vertical').textContent = counterSekatVertical;
            document.getElementById('count-gantungan').textContent = counterGantungan;
        }

        let currentVerticalSize = 150;
        let currentHorizontalSize = 70;

        let selectedKayuPrice = 0;

        // Fungsi untuk mengupdate garis dan teks
        function updateDimensions() {
            // Ambil nilai baru dari input
            let newVerticalSize = document.getElementById('input-vertical-size').value;
            let newHorizontalSize = document.getElementById('input-horizontal-size').value;

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

        document.getElementById('input-vertical-size').addEventListener('change', function() {
            updateDimensions();
        });
        document.getElementById('input-horizontal-size').addEventListener('change', function() {
            updateDimensions();
        });


        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai

        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai
        let kayuData = @json($detail);
        let addonPrices = @json($addon);
        console.log(jeniskayu);
        console.log(addonPrices);


        // Variabel untuk menyimpan total harga
        let hargakayu = 0;
        let totalPrice = 0;


        // Fungsi untuk memperbarui total harga di UI
        function updateTotalPrice(selectedKayuPrice) {
            hargakayu = parseInt(selectedKayuPrice);
            let finalPrice = totalPrice + parseInt(selectedKayuPrice);
            document.getElementById('total-price').textContent = finalPrice;
        }

        function updateTotalPrice2(){
             let finalPrice = totalPrice + hargakayu;
            document.getElementById('total-price').textContent = finalPrice;
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
                    scaleX = canvasWidth / imgWidth;
                    scaleY = 0.3;
                    counterSekatHorizontal++;
                    totalPrice += addonPrices.sekatHorizontal; // Tambahkan harga sekatHorizontal
                } else if (imageURL.includes('sekatvertical')) {
                    scaleX = 0.3;
                    scaleY = canvasHeight / imgHeight;
                    counterSekatVertical++;
                    totalPrice += addonPrices.sekatvertical; // Tambahkan harga sekatVertical
                } else if (imageURL.includes('gantungan')) {
                    scaleX = canvasWidth / imgWidth;
                    scaleY = 0.5;
                    counterGantungan++;
                    totalPrice += addonPrices.gantungan; // Tambahkan harga gantungan
                }

                img.scaleX = scaleX;
                img.scaleY = scaleY;

                updateCounters();
                updateTotalPrice2(); // Perbarui total harga di UI

                img.lockRotation = true;

                if (imgHeight > imgWidth) {
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
                } else {
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
                }

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
                        totalPrice -= addonPrices.sekatHorizontal; // Kurangi harga sekatHorizontal
                    } else if (imageURL.includes('sekatvertical')) {
                        counterSekatVertical--;
                        totalPrice -= addonPrices.sekatvertical; // Kurangi harga sekatVertical
                    } else if (imageURL.includes('gantungan')) {
                        counterGantungan--;
                        totalPrice -= addonPrices.gantungan; // Kurangi harga gantungan
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

        document.getElementById('saveDiv').addEventListener('click', function() {
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

        // document.getElementById('btn-beli').addEventListener('click', function() {
        //     // Ambil elemen produk-div
        //     var element = document.getElementById('produk-div');

        //     // Gunakan html2canvas untuk membuat screenshot dari elemen
        //     html2canvas(element).then(function(canvas) {
        //         // Ubah canvas menjadi URL gambar base64
        //         var dataURL = canvas.toDataURL('image/png');

        //         fetch('/seller/save-image', {
        //                 method: 'POST',
        //                 headers: {
        //                     'Content-Type': 'application/json',
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                         .getAttribute('content')
        //                 },
        //                 body: JSON.stringify({
        //                     image: dataURL
        //                 })
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     alert('GAmbar berhasil disimpan');
        //                 } else {
        //                     alert("gambar gagal disimpan");
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error:', error);
        //                 alert('Terjadi kesalahan saat mengirim gambar');
        //             });


        //         // ini untuk save foto ke download
        //         // Buat elemen link sementara
        //         // var link = document.createElement('a');
        //         // link.href = dataURL;

        //         // Set nama file untuk download
        //         // link.download = 'produk-div-image.png';

        //         // Trigger klik untuk download gambar
        //         // link.click();
        //     });
        // });

        document.getElementById('next-page').addEventListener('click', function() {
            // Ambil data dari canvas dalam format JSON
            const canvasDesign = canvas.toJSON();

            // Simpan JSON ke localStorage untuk digunakan di halaman kedua
            localStorage.setItem('canvasDesign', JSON.stringify(canvasDesign));

            const addonData = {
                sekatHorizontal: counterSekatHorizontal,
                sekatVertical: counterSekatVertical,
                gantungan: counterGantungan
            };
            localStorage.setItem('addonData', JSON.stringify(addonData));

            // Simpan data ukuran
            const ukuranData = {
                tinggi: currentVerticalSize,
                panjang: currentHorizontalSize
            };
            localStorage.setItem('ukuranData', JSON.stringify(ukuranData));

            // Simpan total harga
            localStorage.setItem('totalPrice', totalPrice);

            // Redirect ke halaman kedua
            window.location.href = "{{ url('/masteruser/produkCustom/h2lemari1') }}";
        });
    </script>

@endsection
