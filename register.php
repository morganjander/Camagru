<?php
require_once 'init.php';

if (Input::exists()) {
    if (token::check(input::get('token'))) {//protect against csrf
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
            $user = new user();
            $salt = hash::salt(32);
            $code = hash::salt(32);
            echo "Stored:<br>";
            
            try {
                $user->create(array(
                    'username' => input::get('username'),
                    'password' => hash::make(input::get('password'), $salt),
                    'salt' => $salt,
                    'email' => input::get('email'),
                    'verification_token' => $code,
                    'verified' => 0
                ));

                $result = $user->find(input::get('username'));
                if ($result) {
                $results = $user->data();
                $saltcode = $results->verification_token;
                $user->update($results->id, array(
                    'password' => hash::make(input::get('password'), $results->salt),
                    'verification_token' => hash::make('code', $saltcode) //because retrieving salt from the database changes it argh                 
                ));
                $code = hash::make('code', $saltcode);
            }
        
                if ($validation->send_email(input::get('email'), $code)) {
                    echo 'Please check your email';
                }
            } catch (Exception $e) {
                die ($e->getMessage());
            }

            
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
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