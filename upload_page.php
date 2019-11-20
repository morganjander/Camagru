<?php
require_once 'init.php';
include_once("includes/footer.html");
?>
<br>
<br>
<br> <?php
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
<br>
<div class = "box column is-7 has-text-centered is-10 is-offset-1">
        <h3 class = "subtitle">Live Image</h3> 
        <video id="video" width="500" height="300" ></video>
        <br/>
        <button class = "button is-small" style="background-color:#f35588" id="snap">Take Photo</button><br>
        <br/>
        <h3 class = "subtitle">Captured Photo</h3>
        <canvas id="canvas" width="400" height="300"></canvas>
    <form method="post" action="functions/upload_image.php" enctype="multipart/form-data">
        <input type="file" id="image" name="image">
        <button class = "button" style="background-color:#f35588" id="submitphoto">Submit File</button><br>
        <input type="hidden" id="image1" name="image1" value="">
        
    </form>
</div>
    <br >
    <script src="photo.js"></script>
    <br>
    <br>
    <br>