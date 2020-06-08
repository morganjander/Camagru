<?php
require_once 'init.php';
include_once("includes/header.html");
include_once("includes/footer.html");

if (session::exists('image upload success')) {
    echo session::flash('image upload success');
}
if (session::exists('no file')) {
    echo session::flash('no file');
}
$user = new user();
if (!$user->isLoggedIn()) {
    session::flash('login to upload', 'Please login or register to add photos');
    redirect::to('index.php');
}
?>
<div style="margin-top: 120px; margin-bottom: 120px;">
<div style="text-align:center;">
<h3>Live Image</h3> 
</div>
<div style="text-align:center;">
<video id="video" width="400" height="300" ></video>
</div>
<div style="text-align:center;">
<button class="btn btn-default" id="snap">Take Photo</button><br>
</div>   
<div style="text-align:center;">
<h3>Captured Photo</h3>
<canvas id="canvas" width="400" height="300"></canvas>
</div>        
<div style="text-align:center;">
<form method="post" action="functions/upload_image.php" enctype="multipart/form-data">
        <input type="file" id="image" name="image">
        <button  class="btn btn-default" id="submitphoto">Submit File</button><br>
        <input type="hidden" id="image1" name="image1" value="">
    </form>
    <script src="photo.js"></script>
</div>      
    

    
  