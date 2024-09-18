@extends('template.MasterDesain')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Dashboard')

@section('style')
<style>

.drawing-area{
        position: absolute;
        top: 23px;
        left: 33px;
        z-index: 10;
        width: 200px;
        height: 30px;
    }

    .canvas-container{
        width: 200px;
        height: 400px;
        position: relative;
        user-select: none;
    }

    #produk-div{
        width: 452px;
        height: 548px;
        position: relative;
        background-color: #fff;
    }

    #canvas{
        position: absolute;
        width: 200px;
        height: 370px;
        left: 0px;
        top: 0px;
        user-select: none;
        cursor: default;
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
        <h2 class="fw-bold py-3 mb-4">Template Mebel</h2>

        {{-- <img id="template" src="{{url("img/test.png")}}" style="width: 1000px"/> --}}
        <div class="card" style="padding: 15px">

            <div id="produk-div">
                <!--
                    Initially, the image will have the background tshirt that has transparency
                    So we can simply update the color with CSS or JavaScript dinamically
                -->
                {{-- <img id="template" src="{{url("img/bajuhitam.png")}}"/> --}}
                <img id="template" src="{{url("img/lemaribener.png")}}" style="width: 100%;height: 100%;"/>

                <div id="drawingArea" class="drawing-area"  >
                    <div class="canvas-container" >
                        <canvas id="tshirt-canvas" width="390px" height="480" style="border-style: solid; border-width: 2px" ></canvas>
                    </div>
                </div>
            </div>

            <!-- The select that will allow the user to pick one of the static designs -->
            <br>
            <label for="tshirt-design">add on</label>
            <select id="tshirt-design">
                <option value="">pilih...</option>
                
                <option value="{{url('img/sekatHorizontal.jpeg')}}">sekat horizontal</option>
                <option value="{{url('img/sekatvertical.jpeg')}}">sekat vertical </option>
                <option value="{{url('img/gantungan.jpeg')}}">gantungan</option>
                
               
            </select>
                 
            <button id="btntambah">tambah</button>

            <button id="remove">delete</button>

            <!-- The Select that allows the user to change the color of the T-Shirt -->
            <br><br>
            <label for="tshirt-color" hidden>T-Shirt Color:</label>
            <select id="tshirt-color" hidden>
                <!-- You can add any color with a new option and definings its hex code -->
                <option value="#fff">White</option>
                <option value="#000">Black</option>
                <option value="#f00">Red</option>
                <option value="#008000">Green</option>
                <option value="#ff0">Yellow</option>
            </select>

            <br><br>
    
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
    $('#remove').click(function(){
    var object = canvas.getActiveObject();
    if (!object){
        alert('Please select the element to remove');
        return '';
    }
    canvas.remove(object);
});

let canvas = new fabric.Canvas('tshirt-canvas');

// Fungsi untuk membatasi gerakan objek pada kanvas
canvas.on('object:moving', function(e) {
    var obj = e.target;
    var canvasWidth = canvas.getWidth();
    var canvasHeight = canvas.getHeight();

    if(obj.left < 0) {
        obj.left = 0;
    }
    if(obj.left + obj.width * obj.scaleX > canvasWidth){
        obj.left = canvasWidth - obj.width * obj.scaleX;
    }

    if(obj.top < 0) {
        obj.top = 0;
    }

    if(obj.top + obj.height * obj.scaleY > canvasHeight){
        obj.top = canvasHeight - obj.height * obj.scaleY;
    }
});

// Fungsi untuk membatasi skala objek saat diperbesar atau diperkecil
canvas.on('object:scaling', function(e){
    var obj = e.target;
    var canvasWidth = canvas.getWidth();
    var canvasHeight = canvas.getHeight();

    var objWidth = obj.width * obj.scaleX;
    var objHeight = obj.height * obj.scaleY;

    if(objWidth > canvasWidth){
        obj.scalex = canvasWidth / obj.width;
    }
    if(objHeight > canvasHeight){
        obj.scaleY = canvasHeight / obj.height;
    }

    obj.setCoords();
    canvas.renderAll();
});

// Fungsi untuk menambahkan gambar ke kanvas dengan skala yang sesuai
function updateTshirtImage(imageURL) {
    if (!imageURL) {
        return;
    }

    fabric.Image.fromURL(imageURL, function(img) {
        var canvasWidth = canvas.getWidth();
        var canvasHeight = canvas.getHeight();

        var imgWidth = img.width;
        var imgHeight = img.height;

        // Hitung skala gambar agar sesuai dengan kanvas tanpa distorsi
        var scaleX = canvasWidth / imgWidth;
        var scaleY = canvasHeight / imgHeight;
        var scale = Math.min(scaleX, scaleY);

        // Skala gambar berdasarkan ukuran kanvas
        img.scale(scale);

        // Identifikasi apakah gambar vertikal atau horizontal
        if (imgHeight > imgWidth) {
            // Gambar vertikal, kunci scaling di sumbu X (horizontal)
            img.lockScalingX = true; // Disable horizontal scaling
            img.scaleX = 0.3; // Skala X lebih kecil agar lebih tipis

            // Sembunyikan kontrol scaling horizontal (left dan right)
            img.setControlsVisibility({
                mt: true,   // middle top (untuk scaleY)
                mb: true,   // middle bottom (untuk scaleY)
                ml: false,  // middle left (untuk scaleX)
                mr: false,  // middle right (untuk scaleX)
                tl: false,  // top-left corner (untuk scaleX dan scaleY)
                tr: false,  // top-right corner (untuk scaleX dan scaleY)
                bl: false,  // bottom-left corner (untuk scaleX dan scaleY)
                br: false   // middle right (untuk scaleX)
            });
        } else {
            // Gambar horizontal, kunci scaling di sumbu Y (vertikal)
            img.lockScalingY = true; // Disable vertical scaling
            img.scaleY = 0.3; // Skala Y lebih kecil agar lebih tipis

            // Sembunyikan kontrol scaling vertikal (top dan bottom)
            img.setControlsVisibility({
                mt: false,  // middle top (untuk scaleY)
                mb: false,  // middle bottom (untuk scaleY)
                ml: true,   // middle left (untuk scaleX)
                mr: true,   // middle right (untuk scaleX)
                tl: false,  // top-left corner (untuk scaleX dan scaleY)
                tr: false,  // top-right corner (untuk scaleX dan scaleY)
                bl: false,  // bottom-left corner (untuk scaleX dan scaleY)
                br: false   // middle right (untuk scaleX)
            });
        }

        // Kunci rotasi gambar
        img.lockRotation = true;  // Disable rotation

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

            // Jika gambar vertikal, cek bahwa scaling Y tidak melebihi kanvas
            if (imgHeight > imgWidth && obj.getScaledHeight() > canvasHeight) {
                obj.scaleY = canvasHeight / obj.height;
            }

            // Jika gambar horizontal, cek bahwa scaling X tidak melebihi kanvas
            if (imgWidth > imgHeight && obj.getScaledWidth() > canvasWidth) {
                obj.scaleX = canvasWidth / obj.width;
            }

            obj.setCoords();  // Update koordinat setelah scaling
        });

        // Tambahkan gambar ke kanvas
        canvas.add(img);

        // Tampilkan dimensi gambar
        
        canvas.renderAll();
    });
}

// Event listener untuk tombol tambah gambar
document.getElementById('btntambah').addEventListener('click', function(){
    updateTshirtImage(document.getElementById('tshirt-design').value);
}, false);

// Fungsi untuk menghapus objek ketika tombol DEL ditekan
document.addEventListener("keydown", function(e) {
    var keyCode = e.keyCode;

    if (keyCode == 46) {
        canvas.remove(canvas.getActiveObject());
    }
}, false);

</script>

@endsection
