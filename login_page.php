<?php
require_once 'init.php';
include_once("includes/header.html");
?>
<br>
<br>
<br> <?php
if (session::exists('updated')) {
    echo session::flash('updated');
}
if (session::exists('verified')) {
    session::flash('verified');
    echo '<script type="text/javascript">alert("Thank you for verifying your email; you can now login");</script>';
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
if (session::exists('email')) {
    echo session::flash('email');
}
?>



<br>

<html lang="en">
<body>
<div class="signup-form">
    <form action="functions/login_user.php" method="post">
		<h2>Log In</h2>
        <div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username" required="required" id="username" value="<?php echo escape(Input::get('username'))?>">	      	
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="password" value="<?php echo escape(Input::get('email'))?>" id="email">
        </div>
        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo token::generate();?>">
            <button type="submit" class="btn btn-default btn-lg btn-block" >Log In</button>
        </div>
    </form>
    <div class="text-center">Don't have an account? <a href="register_page.php">Register here</a></div>
    <div class="text-center">Forgot password? <a href="forgot_password.php">Click here</a></div>
</div>
</body>
</html>
