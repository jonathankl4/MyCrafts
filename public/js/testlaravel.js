
    // Select the canvas an make it accesible for all the snippets of this article
let canvas = new fabric.Canvas('tshirt-canvas');

/**
 * Method that defines a picture as background image of the canvas.
 *
 * @param {String} imageUrl      The server URL of the image that you want to load on the T-Shirt.
 *
 * @return {void} Return value description.
 */
function updateTshirtImage(imageURL){
    // If the user doesn't pick an option of the select, clear the canvas
    if(!imageURL){
        canvas.clear();
    }

    // Create a new image that can be used in Fabric with the URL
    fabric.Image.fromURL( "storage/testimg/batman.png", function(img) {
        // Define the image as background image of the Canvas
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            // Scale the image to the canvas size
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height
        });
    });
}


// 1. When the T-Shirt color select changes:
// Update the TShirt color according to the selected color by the user
document.getElementById("tshirt-color").addEventListener("change", function(){
    document.getElementById("tshirt-div").style.backgroundColor = this.value;
}, false);

// 2. When the user picks a design:
// Update the TShirt background image according to the selected image by the user
document.getElementById("tshirt-design").addEventListener("change", function(){

    // Call the updateTshirtImage method providing as first argument the URL
    // of the image provided by the select
    updateTshirtImage(this.value);
}, false);

