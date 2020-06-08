<?php
require_once 'init.php';
include_once("includes/header.html");
?>
<?php
if (session::exists('email')) {
    echo "<br>
    <br>
    <br> ";
    echo session::flash('email');
}
if (session::exists('error')) {
    echo "<br>
    <br>
    <br> ";
    echo session::flash('error');
}
?>
<br>
</head>
<body>
<div class="signup-form">
    <form action="functions/register_user.php" method="post">
		<h2>Register</h2>
        <div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username" required="required" id="username" value="<?php echo escape(Input::get('username'))?>">	      	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required" value="<?php echo escape(Input::get('email'))?>" id="email">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="password">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Confirm Password" required="required" id="repeat_password">
        </div>        
		<div class="form-group">
            <input type="hidden" name="token" value="<?php echo token::generate();?>">
            <button type="submit" class="btn btn-default btn-lg btn-block" >Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="login_page.php">Log in</a></div>
</div>
</body>
</html>