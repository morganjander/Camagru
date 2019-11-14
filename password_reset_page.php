<?php
require_once 'init.php';
include_once("includes/footer.html");
$user = new user();
    if (!$user->isLoggedIn()){
        session::flash('login to like', 'Please login or register to like or comment on photos');
        redirect::to('index.php');
    }
?>
<br>
<br>
<br> <?php
if (session::exists('reset_error')) {
    echo session::flash('reset_error');
}
if (session::exists('password_updated')) {
    echo session::flash('password_updated');
}
?>
<br>
<form action="functions/reset_user_password.php" method="post">
<div class = "box column is-7 is-offset-one-quarter has-text-centered">
<h3>Reset your password</h3>     
    <div class="field">
    <label for="password">Choose a new password</label>
    <input type="password" name="password" id="password">
    </div>

    <div class="field">
    <label for="repeat_password">Repeat new password</label>
    <input type="password" name="repeat_password" id="repeat_password">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Reset Password"> 
</div>
</form>