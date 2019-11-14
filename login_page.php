<?php
require_once 'init.php';
?>
<br>
<br>
<br> <?php
if (session::exists('updated')) {
    echo session::flash('updated');
}
if (session::exists('notverified')) {
    echo session::flash('notverified');
}
if (session::exists('notcorrect')) {
    echo session::flash('notcorrect');
}
if (session::exists('loginerror')) {
    echo session::flash('loginerror');
}

?>



<br>

<html>
<form action="functions/login_user.php" method="post">
<div class = "box column is-7 is-offset-one-quarter has-text-centered">
<h3>Enter your details to login</h3> 
    <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    </div>

    <div class="field">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Log in" class="button" style="background-color:#f35588"> <a href="forgot_password.php">Forgot Password?</a>
</div>
</form>
</html>

