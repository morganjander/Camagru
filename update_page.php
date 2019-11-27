<?php
require_once 'init.php';
include_once("includes/footer.html");
$user = new user();
?>
<br>
<br>
<br> <?php
if (session::exists('updated')) {
    echo session::flash('updated');
}
if (session::exists('error')) {
    echo session::flash('error');
}
if (!$user->isLoggedIn()) {
    redirect::to('index.php');
}
?>   
<form action="functions/update_username.php" method="post">
    <div class="field">
    <label for="username">Change Username</label>
    <input type="text" name="username" value="<?php echo escape($user->data()->username);?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" style="background-color:#f35588" value="Update"> 
</form> 
