<?php
require_once 'init.php';
if (empty($_GET['code']) || empty($_GET['user'])){
    redirect::to('index.php');
}
else {
    $user = new user();
    $result = $user->find($_GET['user']);
    if ($result) {
        $results = $user->data();
        $token = $results->verification_token;
        if ($token === $_GET['code']) {
            if (Input::exists()) {
                if (token::check(input::get('token'))) {
                    $validate = new Validate();
                    $validation = $validate->check($_POST, array(
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
                            try {
                                    $user->update($results->id, array(
                                    'password' => hash::make(input::get('password'), $results->salt)
                                    ));
                                    echo "password updated successfully";
                                    $user->logout();

                            } catch (Exception $e) {
                                die ($e->getMessage());
                            }


                        }

                }
            }
    }
}
}

?>

<form action="" method="post">
    
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