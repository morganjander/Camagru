<?php
require_once 'init.php';
if (session::exists('upload success')) {
    echo session::flash('upload success');
}
if (session::exists('updated')) {
    echo session::flash('updated');
}
$user = new user();
if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="#"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="update.php">Change Username</a></li>
    <li><a href="password_reset.php">Change Password</a></li>
    <li><a href="email_preference.php">Update Email Preferences</a></li>
    <li><a href="functions/logout_user.php">Logout</a></li>
    </ul>
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


    <?php

    } else {
        echo '<p>You need to <a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
    }
    ?>
    