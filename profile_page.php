<?php
require_once 'init.php';
include 'functions/display_user_photos.php';
include_once("includes/header.html");
include_once("includes/footer.html");
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

?><br><br><br><br>
<h1 class='font-weight-light text-left mt-4 mb-0'><?php echo escape($user->data()->username);?>'s Gallery</h1>
<?php
display_user_photos($user->data()->id);

} else {
    session::flash('not logged in', 'You are not logged in');
    redirect::to('index.php');
}
?>
    