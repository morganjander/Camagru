<
<?php
require_once 'init.php';
$user = new user();
if (!$user->isLoggedIn()) {
    redirect::to('index.php');
}
?>   
<form action="functions/update.php" method="post">
    <div class="field">
    <label for="username">Change Username</label>
    <input type="text" name="username" value="<?php echo escape($user->data()->username);?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Update"> 
</form> 
