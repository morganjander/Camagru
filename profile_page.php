<?php
require_once 'init.php';
include 'functions/display_all_photos.php';
?>
<br>
<br>
<br> <?php
if (session::exists('upload success')) {
    echo session::flash('upload success');
}
if (session::exists('image delete success')) {
    echo session::flash('image delete success');
}

if (session::exists('updated')) {
    echo session::flash('updated');
}
$user = new user();
if ($user->isLoggedIn()) {
include_once("includes/footer.html");
    ?>
    <br>
    <br>
    <p>Hello <a href="#"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="update_page.php">Change Username</a></li>
    <li><a href="password_reset_page.php">Change Password</a></li>
    <li><a href="email_preference_page.php">Update Email Preferences</a></li>
    </ul>
<?php
display_all_photos($user->data()->username);
?>
    <br>
<br>
<br>
<br>
<?php
} else {
    ?>
    <br>
<br>
<br>
<br>
<?php
        echo '<p>You need to <a href="login_page.php">Log in</a> or <a href="register_page.php">Register</a></p>';
}
?>
    