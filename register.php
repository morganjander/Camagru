<?php
require_once 'init.php';
if (session::exists('email')) {
    echo session::flash('email');
}
if (session::exists('error')) {
    echo session::flash('error');
}
?>
<html>
<form action="functions/register_user.php" method="post">
    <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off">
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
    <input type="submit" value="Register"> 
</form>
</html>