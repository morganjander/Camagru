<?php
require_once 'init.php';
include_once("includes/header.html");
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
<br>
<br>
<div style="text-align:center; width: 400px;">
    <form action="functions/update_username.php" method="post">
		<h2>Change Username</h2>
        <div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username" required="required" id="username" value="<?php echo escape($user->data()->username);?>">	      	
        </div>
        <div class="form-group">
            <input type="hidden" name="token" value="<?php echo token::generate();?>">
            <button type="submit" class="btn btn-default btn-lg btn-block" >Update</button>
        </div>
    </form>
</div>

