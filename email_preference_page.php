<?php
    require_once 'init.php';
    include_once("includes/footer.html");
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('index.php');
    }
    if (Input::exists()) {
        if (token::check(input::get('token'))) {
            if (input::get('yes')) {
                $email = 1;
            } else {
                $email = 0;
            }
                try {
                    $user->update($user->data()->id, array(
                        'comment_email' => $email
                    ));
                    echo "Details updated successfully";
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            
        }
    }
    ?>

<form action="" method="post">
    <div class="field">
    <label>Would you like to receive email notifications?</label>
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <input type="submit" name="yes" value="Yes">
    <input type="submit" name="no" value="No"> 
</form>