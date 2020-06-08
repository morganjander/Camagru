<?php
require_once 'init.php';
include_once("includes/header.html");
$user = new user();
if ($user->isLoggedIn()){
    include_once("includes/footer.html");
}else {
    include_once("includes/footer logged_out.html");
}
if (!$user->isLoggedIn() && (empty($_GET['code']) || empty($_GET['user'])) && !session::exists('password_updated')){
    redirect::to('index.php');
}
?>
<br>
<br>
<br> <?php
if (session::exists('reset_error')) {
    echo "<br>
    <br>
    <br>";
    echo session::flash('reset_error');
}
if (session::exists('password_updated')) {
    echo "<br>
    <br>
    <br>";
    echo session::flash('password_updated');
}
?>
<br>
<br>
<div style="width: 400px;">
    <form action="functions/reset_user_password.php" method="post">
		<h2>Reset your password</h2>
        <div style="text-align:left; width: 400px;">
            <label for="password">New password</label>
            <span style="text-align:right;"><input type="password" name="password" id="password"></span>   	
        </div>
        
        <div style="text-align:left; width: 400px;">
            <label for="repeat_password">Confirm new password</label>
            <span style="text-align:right;"><input type="password" name="repeat_password" id="repeat_password"></span> 
            <input type="hidden" name="token" value="<?php echo token::generate();?>">
            <input type="hidden" name="user" value="<?php echo $_GET['user'];?>">
            <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">
            <button type="submit" class="btn btn-default btn-lg btn-block" >Reset</button>
        </div>
    </form>
</div>