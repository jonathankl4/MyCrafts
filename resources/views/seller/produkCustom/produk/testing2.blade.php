@extends('template.MasterDesain')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', 'Dashboard')

@section('style')
<style>
    .content-container {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    #left-panel {
        width: 200px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #canvas-container {
        position: relative;
        width: 452px;
        height: 548px;
        background-color: #fff;
    }

    .canvas-container {
        width: 100%;
        height: 100%;
        position: relative;
        user-select: none;
    }

    #tshirt-canvas {
        border-style: solid;
        border-width: 2px;
    }

    #image-count {
        font-weight: bold;
        font-size: 16px;
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
    <div class="flex-grow-1 container-p-y" style="width: 100%; padding: 10px;">
        <h2 class="fw-bold py-3 mb-4">Template Mebel</h2>
        <div class="content-container">
            <!-- Left panel for select and buttons -->
            <div id="left-panel">
                <!-- The select that will allow the user to pick one of the static designs -->
                <label for="tshirt-design">Add-on</label>
                <select id="tshirt-design">
                    <option value="">Pilih...</option>
                    <option value="{{url('img/sekatHorizontal.jpeg')}}">Sekat Horizontal</option>
                    <option value="{{url('img/sekatvertical.jpeg')}}">Sekat Vertical</option>
                    <option value="{{url('img/gantungan.jpeg')}}">Gantungan</option>
                </select>

                <button id="btntambah">Tambah</button>
                <button id="remove">Hapus</button>

                <br>

                <!-- Counter for the number of images in the canvas -->
                <div id="image-count">Gambar di Kanvas: 0</div>
            </div>

            <!-- Right panel for the canvas -->
            <div id="canvas-container">
                <div class="canvas-container">
                    <canvas id="tshirt-canvas" width="390px" height="480"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')



<script>
  // Add an event listener to the button
// Variabel untuk menghitung gambar yang ada di canvas
let imageCounter = 0;

function setCanvasBackground(imageURL) {
    fabric.Image.fromURL(imageURL, function(img) {
        var canvasWidth = canvas.getWidth();
        var canvasHeight = canvas.getHeight();

        // Hitung skala untuk gambar background agar sesuai dengan kanvas
        var scaleX = canvasWidth / img.width;
        var scaleY = canvasHeight / img.height;
        var scale = Math.min(scaleX, scaleY);
        img.scale(scale);

        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: scale,
            scaleY: scale
        });
    });
}

// Fungsi untuk memuat gambar lemari sebagai background ketika halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    setCanvasBackground('{{url("img/lemaribener.png")}}');
});


// Fungsi untuk mengupdate counter
function updateImageCounter() {
    document.getElementById('image-count').textContent = `Gambar di Kanvas: ${imageCounter}`;
}

// Fungsi untuk menambah gambar ke canvas
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
            img.lockScalingX = true;
            img.scaleX = 0.3; // Skala X lebih kecil agar lebih tipis
        } else {
            // Gambar horizontal, kunci scaling di sumbu Y (vertikal)
            img.lockScalingY = true;
            img.scaleY = 0.3; // Skala Y lebih kecil agar lebih tipis
        }

        // Kunci rotasi gambar
        img.lockRotation = true;

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

            obj.setCoords(); // Update koordinat setelah scaling
        });

        // Tambahkan gambar ke kanvas
        canvas.add(img);
        imageCounter++;  // Tambah gambar ke counter
        updateImageCounter(); // Perbarui jumlah gambar di kanvas

        // Tambahkan event listener untuk hapus gambar
        img.on('removed', function() {
            imageCounter--;
            updateImageCounter(); // Perbarui counter setelah gambar dihapus
        });

        canvas.renderAll();
    });
}

// Event listener untuk tombol tambah gambar
document.getElementById('btntambah').addEventListener('click', function() {
    updateTshirtImage(document.getElementById('tshirt-design').value);
}, false);

// Fungsi untuk menghapus objek ketika tombol DEL ditekan
document.getElementById('remove').addEventListener('click', function() {
    var object = canvas.getActiveObject();
    if (!object) {
        alert('Pilih gambar yang ingin dihapus');
        return;
    }
    canvas.remove(object); // Hapus gambar dari kanvas
});

// Inisialisasi canvas
let canvas = new fabric.Canvas('tshirt-canvas');


</script>

@endsection
