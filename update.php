<?php
    require_once 'init.php';
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('index.php');
    }
    if (Input::exists()) {
        if (token::check(input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                )
            ));
            if ($validation->passed()) {
                try {
                    $user->update($user->data()->id, array(
                        'username' => input::get('username')
                    ));
                    echo "Details updated successfully";
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            }
        }
    }
    ?>

<form action="" method="post">
    <div class="field">
    <label for="username">Change Username</label>
    <input type="text" name="username" id="username" value="<?php echo escape($user->data()->username);?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" value="Update"> 
</form>