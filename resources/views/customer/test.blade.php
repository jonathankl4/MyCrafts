<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Static Tee Designer</title>
        <style>
            .drawing-area{
                position: absolute;
                top: 60px;
                left: 122px;
                z-index: 10;
                width: 200px;
                height: 400px;
            }

            .canvas-container{
                width: 200px;
                height: 400px;
                position: relative;
                user-select: none;
            }

            #tshirt-div{
                width: 452px;
                height: 548px;
                position: relative;
                background-color: #fff;
            }

            #canvas{
                position: absolute;
                width: 200px;
                height: 400px;
                left: 0px;
                top: 0px;
                user-select: none;
                cursor: default;
            }
        </style>
    </head>
    <body>
        <!-- Create the container of the tool -->
        <div id="tshirt-div">
            <!--
                Initially, the image will have the background tshirt that has transparency
                So we can simply update the color with CSS or JavaScript dinamically
            -->
            <img id="tshirt-backgroundpicture" src="img/bajuhitam.png"/>

            <div id="drawingArea" class="drawing-area">
                <div class="canvas-container">
                    <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                </div>
            </div>
        </div>

        <!-- The select that will allow the user to pick one of the static designs -->
        <br>
        <label for="tshirt-design">T-Shirt Design:</label>
        <select id="tshirt-design">
            <option value="">Select one of our designs ...</option>
            <option value="img/batman.png">Batman</option>
        </select>

        <!-- The Select that allows the user to change the color of the T-Shirt -->
        <br><br>
        <label for="tshirt-color">T-Shirt Color:</label>
        <select id="tshirt-color">
            <!-- You can add any color with a new option and definings its hex code -->
            <option value="#fff">White</option>
            <option value="#000">Black</option>
            <option value="#f00">Red</option>
            <option value="#008000">Green</option>
            <option value="#ff0">Yellow</option>
        </select>

        <br><br>
<label for="tshirt-custompicture">Upload your own design:</label>
<input type="file" id="tshirt-custompicture" />

        <!-- Include Fabric.js in the page -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/510/fabric.min.js"></script>

        <script>
            let canvas = new fabric.Canvas('tshirt-canvas');

            function updateTshirtImage(imageURL){
    fabric.Image.fromURL(imageURL, function(img) {
        img.scaleToHeight(300);
        img.scaleToWidth(300);
        canvas.centerObject(img);
        canvas.add(img);
        canvas.renderAll();
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
    </body>
</html>
