<?php

require_once 'init.php';
echo session::flash('success');
if (token::check(input::get('token'))) {
    
    $validate = new validate();
    $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)
    ));

    if ($validation->passed()) {

        $user = new user();
        $login = $user->login(input::get('username'), input::get('password'));
        $result = $user->find(input::get('username'));
        if ($result) {
            $verified = $user->data()->verified;
        }

        if ($login && $verified) {
            redirect::to('index.php');
        } else if(!$verified) {
            echo "Please verify your email first";
        } else {
            echo '<p>Login failed</p>';
        }

    } else {
        foreach ($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>
<form action="" method="post">
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