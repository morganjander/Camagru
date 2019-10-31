<?php
require_once 'init.php';
if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array (
        'username' => array(
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'email' => array(
            'required' => true,
            'valid' => true,
        ),
        'password' => array(
            'required' => true,
            'min' => 6,
            'upper' => true
        ),
        'repeat_password' => array(
            'required' => true,
            'matches' => 'password'
        )
    ));
   if ($validation->passed()) {
        echo 'passed';
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