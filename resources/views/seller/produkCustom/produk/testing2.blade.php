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
            {{-- <select id="tshirt-design">
                <option value="">pilih...</option>
                
                <option value="{{url('img/sekatHorizontal.jpeg')}}">sekat horizontal</option>
                <option value="{{url('img/testvertical.jpeg')}}">sekat vertical </option>
                <option value="{{url('img/crop.jpeg')}}">sekat vertical </option>
               
            </select> --}}
            <select id="tshirt-design">
                <option value="">Pilih...</option>
                <option value="{{url('img/batman.png')}}">Batman</option>
                <option value="{{url('img/sekathorizontal.jpeg')}}">Sekat Horizontal</option>
                <option value="{{url('img/testvertical.jpeg')}}">Sekat Vertical</option>
                <option value="{{url('img/crop.jpeg')}}">Sekat Vertical 2</option>
            </select>
            
            
            <canvas id="c" width="800" height="600" style="border:1px solid #000000;"></canvas>
            
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
    {{-- <label for="tshirt-custompicture">Upload your own design:</label>
    <input type="file" id="tshirt-custompicture" /> --}}


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
</script>

<script>
  // Add an event listener to the button
document.getElementById('btntambah').addEventListener('click', function() {
    updateTshirtImage(document.getElementById('tshirt-design').value);
}, false);

// Function to show dimensions of the image on the canvas
function showDimensions(img) {
    const width = Math.round(img.width * img.scaleX);
    const height = Math.round(img.height * img.scaleY);

    // Check if dimension text already exists, if yes, remove it
    canvas.getObjects('text').forEach(function(textObj) {
        canvas.remove(textObj); // remove previous dimensions text
    });

    // Create the dimension text and position it above the image
    const dimensionsText = new fabric.Text(`${width}px x ${height}px`, {
        fontSize: 16,
        left: img.left + img.width * img.scaleX / 2, // center horizontally on image
        top: img.top - 20, // place above the image
        selectable: false
    });

    canvas.add(dimensionsText);
    canvas.renderAll(); // Refresh the canvas
}

// Update the T-shirt design image
function updateTshirtImage(imageURL) {
    if (!imageURL) {
        return;
    }

    // Clear the canvas before adding new image
    canvas.clear();

    fabric.Image.fromURL(imageURL, function(img) {
        var canvasWidth = canvas.getWidth();
        var canvasHeight = canvas.getHeight();

        var imgWidth = img.width;
        var imgHeight = img.height;

        // Scale the image to fit within the canvas
        var scaleX = canvasWidth / imgWidth;
        var scaleY = canvasHeight / imgHeight;
        var scale = Math.min(scaleX, scaleY);

        img.scale(scale);

        // Add image to canvas
        canvas.add(img);

        // Show dimensions of the image on the canvas
        showDimensions(img);

        // Update dimensions on scaling or moving
        img.on('scaling moving', function() {
            showDimensions(img);
        });

    });
}

// Initialize Fabric.js canvas
var canvas = new fabric.Canvas('c', {
    width: 800,
    height: 600
});

</script>

@endsection
