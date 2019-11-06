<?php

require_once 'init.php';
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
<form action="functions/login_user.php" method="post">
    <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'))?>" autocomplete="off">
    </div>

    <div class="field">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Log in"> <a href="forgot_password.php">Forgot Password?</a>
</form>