var image;
var videoflag = 0;
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

document.getElementById('image1').onchange = function(e) {
    var img = new Image();
    img.onload = draw;
    img.onerror = failed;
    img.src = URL.createObjectURL(this.files[0]);
  };
  function draw() {
    context.drawImage(this, 0,0, 400, 300);
    videoflag = 1;
}
  function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
  };

  function chooseimg(){
    var choose = document.querySelectorAll(".filter");

    choose.forEach(function(element){
        element.addEventListener("click",function(){
        image = element;
        if (image && videoflag === 1){
            if (image.src === "http://localhost/Camagru/filter_images/1.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost/Camagru/filter_images/2.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost/Camagru/filter_images/3.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost/Camagru/filter_images/4.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost/Camagru/filter_images/5.png"){
                context.drawImage(image, 30, 60, 400, 300);
            }
            else if (image.src === "http://localhost/Camagru/filter_images/6.png"){
                context.drawImage(image, 65, 114, 300, 200);
            }
            var dataURL = canvas.toDataURL();
            document.getElementById("image_data").value = dataURL;
        }
    });
});}

document.getElementById("submitphoto").addEventListener("click", function() {
    if (videoflag === 1) {
        var dataURL = canvas.toDataURL();
        document.getElementById("image1").value = dataURL;
    }
});

chooseimg();