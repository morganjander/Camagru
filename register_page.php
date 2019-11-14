<?php
require_once 'init.php';
?>
<br>
<br>
<br> <?php
if (session::exists('email')) {
    echo session::flash('email');
}
if (session::exists('error')) {
    echo session::flash('error');
}
?>
<br>
<html>
<form action="functions/register_user.php" method="post">
<div class = "box column is-7 is-offset-one-quarter has-text-centered">
<h3>Enter your details to register</h3>  
    <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off" id="username">
    </div>

    <div class="field">
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo escape(Input::get('email'))?>" id="email">
    </div>

    <div class="field">
    <label for="password">Choose a password</label>
    <input type="password" name="password" id="password">
    </div>

    <div class="field">
    <label for="repeat_password">Enter your password again</label>
    <input type="password" name="repeat_password" id="repeat_password">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Register" class="button" style="background-color:#f35588"> 
</div>
</form>
</html>