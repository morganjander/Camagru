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
$user = new user();
if (!$user->isLoggedIn()) {
    session::flash('login to upload', 'Please login or register to add photos');
    redirect::to('index.php');
}

?>
<div class = "box column is-7 has-text-centered is-10 is-offset-1">
        <h3 class = "subtitle">Live Image</h3> 
        <video id="video" width="400" height="300" autoplay></video>
        <br/>
        <button class = "button is-small" style="background-color:#f35588" id="snap">Take Photo</button><br>
        <br/>
        <h3 class = "subtitle">Current Image</h3>
        <canvas id="canvas" width="400" height="300"></canvas>
        <form method="post" action="">
        <input class = " is-offset-5 has-text-centered" type="file" name="file">
          <button class = "button" style="background-color:#f35588" type="submit" name="submit" id="submitphoto">Submit Photo</button>
        </form>
    </div>
    <br >
    <script src="includes/photo.js"></script>
    <form action="functions/upload_image.php" method="post" enctype="multipart/form-data">
            <div class = "box column is-7 is-offset-1 has-text-centered">
                <div class="field column">
                    <p class="is-one-quarter">
                        <h3>Upload new image:</h3> 
                        <br />
                        <input class = " is-offset-5 has-text-centered" type="file" name="file">
                    </p>
                </div>
                    <div class="field column">
                        <p class="control has-text-centered">
                            <input type="submit" name="submit" class="button" style="background-color:#f35588" value="Upload Now"/>
                            <input type="hidden" name="token" value="<?php echo token::generate();?>">
                            
                        </p>
                    </div>
                </div>
        </form>
    <br>
    <br>
    <br>