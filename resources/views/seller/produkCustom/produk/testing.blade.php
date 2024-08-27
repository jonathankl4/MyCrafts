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
                {{-- <option value="{{url('img/batman.png')}}">Batman</option> --}}
                <option value="{{url('img/sekathorizontal.png')}}">sekat horizontal</option>
                <option value="{{url('img/sekatverticalcoba.png')}}">sekat vertical </option>
                {{-- <option value="storage/testimg/fototest.jpg">toko</option> --}}
            </select>

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
    let canvas = new fabric.Canvas('tshirt-canvas');

    function updateTshirtImage(imageURL){

        if(!imageURL){
        //canvas.clear();
        }

        fabric.Image.fromURL(imageURL, function(img) {
            // Define the image as background image of the Canvas
            img.scaleToHeight(300);
            img.scaleToWidth(300);
            canvas.add(img);

        });
    }

    // Update the TShirt color according to the selected color by the user
    document.getElementById("tshirt-color").addEventListener("change", function(){
        document.getElementById("tshirt-div").style.backgroundColor = this.value;
    }, false);

    // Update the TShirt color according to the selected color by the user
    document.getElementById("tshirt-design").addEventListener("change", function(){

        // Call the updateTshirtImage method providing as first argument the URL
        // of the image provided by the select
        updateTshirtImage(this.value);
    }, false);


    document.getElementById('tshirt-custompicture').addEventListener("change", function(e){
        var reader = new FileReader();

        reader.onload = function (event){
            var imgObj = new Image();
            imgObj.src = event.target.result;

            // When the picture loads, create the image in Fabric.js
            imgObj.onload = function () {
                var img = new fabric.Image(imgObj);

                img.scaleToHeight(300);
                img.scaleToWidth(300);
                canvas.centerObject(img);
                canvas.add(img);
                canvas.renderAll();
            };
        };

        // If the user selected a picture, load it
        if(e.target.files[0]){
            reader.readAsDataURL(e.target.files[0]);
        }
    }, false);

    // When the user selects a picture that has been added and press the DEL key
    // The object will be removed !
    document.addEventListener("keydown", function(e) {
        var keyCode = e.keyCode;

        if(keyCode == 46){
            console.log("Removing selected element on Fabric.js on DELETE key !");
            canvas.remove(canvas.getActiveObject());
        }
    }, false);
</script>

@endsection
