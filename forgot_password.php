<?php
require_once 'init.php';
?>
<br>
<br>
<br> <?php
if (token::check(input::get('token'))) {
    $validate = new validate();
    $validation = $validate->check($_POST, array(
        'email' => array('required' => true)
    ));

if ($validation->passed()) {
    $user = new user();
    $result = $user->find(input::get('email'));
        if ($result) {
            $verified = $user->data()->verified;
            if (!$verified) {
                echo "Please verify your email first";
            } else {
                if ($validation->send_email(input::get('email'), $user->data()->verification_token, 1, null)) {
                    echo 'Please check your email';
                }
            }
        }
}
}
?>
<form action="" method="post">
    <div class="field">
    <label for="email">Enter your email to send reset link</label>
    <input type="text" name="email" id="email">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Send">
</form>