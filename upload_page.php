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

<html>
    <form action="functions/upload_image.php" method="post" enctype="multipart/form-data">
            <div class = "box column is-7 is-offset-one-quarter has-text-centered">
                <div class="field column is-10 is-offset-1">
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
    </html>