<?php
    require_once 'init.php';
    include_once("includes/header.html");
    include_once("includes/footer.html");
    ?>
    <br>
    <br>
    <br> <?php
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('index.php');
    }
    if (Input::exists()) {
        if (token::check(input::get('token'))) {
            if (input::get('yes')) {
                $email = 1;
            } 
            if (input::get('no')) {
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
    <label>Would you like to receive comment email notifications?</label>
    </div>

    <input type="hidden" name="token" value="<?php echo token::generate();?>">
    <button type="submit" name="yes" value="yes" class="btn btn-default btn-lg ">Yes</button>
    <button type="submit" name="no" name="no" value="no" class="btn btn-default btn-lg ">No</button>
</form>