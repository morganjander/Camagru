<?php
require_once 'init.php';
if (session::exists('reset_error')) {
    echo session::flash('reset_error');
}

?>

<form action="functions/reset_user_password.php" method="post">
    
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
</form>