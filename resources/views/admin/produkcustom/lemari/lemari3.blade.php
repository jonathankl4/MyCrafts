@extends('template.MasterDesain')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Dashboard')

@section('style')
    <style>
        .drawing-area {
            position: absolute;
            top: 33px;
            left: 30px;
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
            <h2 class="fw-bold py-3 mb-4">Custom Mebel</h2>

            <div class="row">

                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Desain</h5>

                        <div class="card" style="padding: 15px">

                            <div id="produk-div">
                                <!--
                                                        Initially, the image will have the background tshirt that has transparency
                                                        So we can simply update the color with CSS or JavaScript dinamically
                                                    -->
                                {{-- <img id="template" src="{{url("img/bajuhitam.png")}}"/> --}}
                                <img id="template" src="{{ url('img/lemari3/lemari3baru.png') }}"
                                    style="width: 100%;height: 100%;" />

                                <div id="drawingArea" class="drawing-area">
                                    <div class="canvas-container" style="position: relative">
                                        <canvas id="tshirt-canvas" width="393px" height="555px"
                                            style="border-style: solid; border-width: 2px"></canvas>

                                        <div id="right-line"
                                            style="position: absolute; right: -240px; top: -20px; height:550px; width: 2px; background-color: black;">
                                        </div>
                                        <div id="right-text"
                                            style="position: absolute; right: -320px; top: 50%; transform: translateY(-50%); font-size: 20px;">
                                            150cm</div>

                                        <!-- Garis horizontal di bawah untuk 70cm -->
                                        <div id="bottom-line"
                                            style="position: absolute; left: -20px; bottom: -230px; width: 430px; height: 2px; background-color: black;">
                                        </div>
                                        <div id="bottom-text"
                                            style="position: absolute; left: 50%; bottom: -260px; transform: translateX(-50%); font-size: 20px;">
                                            70cm</div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 40px">

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header"><b>Kustomisasi</b></h5>
                        <div style="padding: 15px">
                            <div class="col-md-6">

                                <div>
                                    <label for="jeniskayu">Jenis Kayu</label>
                                    <select name="" id="jeniskayu" class="form-select">
                                        <option value="">Jati</option>
                                        <option value="">Mahoni</option>
                                        <option value="">Pinus</option>
                                        <option value="">Sungkai</option>
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
                                <div>Jumlah laci kecil: <span id="count-laci">0</span></div>
                            </div>
                            <div class="col-md-6">
                                <label for="tshirt-design" ><b> Add On</b></label>
                                <select id="tshirt-design" class="form-select">
                                    <option value="">pilih...</option>

                                    <option value="{{ url('img/sekatHorizontal.jpeg') }}">sekat horizontal</option>
                                    <option value="{{ url('img/sekatvertical.jpeg') }}">sekat vertical </option>
                                    <option value="{{ url('img/gantungan.jpeg') }}">gantungan</option>
                                    <option value="{{ url('img/lemari2/lacikecil2.png') }}">laci</option>
                                    <option value="{{ url('img/lemari2/lacibesar2.png') }}">laci 2</option>



                                </select>
                                <br>
                                <button id="btntambah" class="btn btn-primary">tambah</button>

                                <button id="remove" class="btn btn-danger">delete</button>
                                <button id="saveDiv" class="btn btn-success">Save AddOn</button>
                            </div>
                            <br><br>
                            <div class="col-md-6">
                                <label for="pintu-design">Pilih Pintu lemari</label>
                                <select id="pintu-design" class="form-select">
                                    <option value="">pilih.</option>
                                    <option value="">tanpa pintu</option>



                                    <option value="{{url('img/lemari1/pintugeser.jpg')}}">pintu 1</option>

                                    <option value="{{url('img/lemari2/pintu2.jpeg')}}">pintu 2</option>
                                    <option value="{{url('img/lemari3/pintu.png')}}">pintu 3</option>


                                </select>
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
        let counterlacikecil = 0;

        // Fungsi untuk memperbarui counter di UI
        function updateCounters() {
            document.getElementById('count-sekat-horizontal').textContent = counterSekatHorizontal;
            document.getElementById('count-sekat-vertical').textContent = counterSekatVertical;
            document.getElementById('count-gantungan').textContent = counterGantungan;
            document.getElementById('count-laci').textContent = counterlacikecil;
        }

        let currentVerticalSize = 150;
        let currentHorizontalSize = 70;

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
        document.getElementById('update-size').addEventListener('click', function() {
            updateDimensions();
        });


        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai
        function updatePintu(imageURL){


            if(currentDoor !== null){
                canvas.remove(currentDoor);
                currentDoor = null;
            }

            // jika memilih tanpa pintu maka akan menjalankan perintah dibawah ini sehingga tidak ada pintu baru yang ditambah
            if(!imageURL || imageURL ===""){
                return;
            }

            fabric.Image.fromURL(imageURL, function(img){
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
                } else if(imageURL.includes('pintugeser')){
                    scaleX = canvasWidth / imgWidth;
                    scaleY = canvasHeight /  imgHeight;
                }
                else if(imageURL.includes('pintu')){
                    scaleX = canvasWidth / imgWidth;
                    scaleY = canvasHeight /  imgHeight;
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
        // Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai
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

                // Default scale values
                var scaleX = 1;
                var scaleY = 1;

                // Tentukan skala berdasarkan jenis gambar
                if (imageURL.includes('sekatHorizontal')) {
                    // Skala khusus untuk sekat horizontal
                    scaleX = canvasWidth / imgWidth; // Sesuaikan lebar dengan kanvas
                    scaleY = 0.3; // Lebih tipis pada sumbu Y untuk sekat horizontal
                    counterSekatHorizontal++; // Tambah counter sekat horizontal
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
                    scaleY = 0.2; // Lebih tipis pada sumbu Y untuk gantungan
                    counterlacikecil++; // Tambah counter gantungan
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
                } else if (imageURL.includes('lacibesar')) {
                    // Skala khusus untuk gantungan
                    scaleX = canvasWidth / imgWidth; // Buat sedikit lebih kecil
                    scaleY = 0.2; // Lebih tipis pada sumbu Y untuk gantungan
                    counterlacikecil++; // Tambah counter gantungan
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
                }

                // Terapkan skala yang ditentukan pada gambar
                img.scaleX = scaleX;
                img.scaleY = scaleY;

                updateCounters(); // Perbarui tampilan counter di UI

                // Kunci rotasi gambar
                img.lockRotation = true; // Disable rotation

                // Sembunyikan kontrol scaling berdasarkan orientasi gambar
                if (imgHeight > imgWidth) {
                    // Jika gambar vertikal, sembunyikan kontrol scaling horizontal

                } else {
                    // Jika gambar horizontal, sembunyikan kontrol scaling vertikal

                }

                // Event listener untuk mencegah gambar di-scale melebihi batas kanvas
                img.on('scaling', function(e) {
                    var obj = e.target;

                    // Cek apakah gambar melebihi batas kanvas
                    if (obj.getScaledWidth() > canvasWidth) {
                        obj.scaleX = canvasWidth / obj.width;
                    }

                    if (obj.getScaledHeight() > canvasHeight) {
                        obj.scaleY = canvasHeight / obj.height;
                    }

                    obj.setCoords();
                    canvas.renderAll();
                    // Update koordinat setelah scaling
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

                    obj.setCoords(); // Update koordinat setelah objek dipindahkan
                    canvas.renderAll();

                });

                // Tambahkan gambar ke kanvas
                canvas.add(img);

                // Event listener untuk mengurangi counter saat gambar dihapus
                img.on('removed', function() {
                    if (imageURL.includes('sekatHorizontal')) {
                        counterSekatHorizontal--; // Kurangi counter sekat horizontal
                    } else if (imageURL.includes('sekatvertical')) {
                        counterSekatVertical--; // Kurangi counter sekat vertical
                    } else if (imageURL.includes('gantungan')) {
                        counterGantungan--; // Kurangi counter gantungan
                    }
                    updateCounters(); // Perbarui tampilan counter di UI
                });

                canvas.renderAll();
            });
        }


        // Event listener untuk tombol tambah gambar
        document.getElementById('btntambah').addEventListener('click', function() {
            updateAddOn(document.getElementById('tshirt-design').value);
        }, false);

        document.getElementById('pintu-design').addEventListener('change',function(){
            updatePintu(document.getElementById('pintu-design').value);
        },false);

        // Fungsi untuk menghapus objek ketika tombol DEL ditekan
        document.getElementById('remove').addEventListener('click', function() {
            var object = canvas.getActiveObject();
            if (!object) {
                alert('Pilih Add-On yang ingin dihapus');
                return;
            }
            canvas.remove(object);
            ; // Hapus gambar dari kanvas
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



    </script>

@endsection
