<?php
    require_once 'init.php';
    $user = new user();
    if ($user->isLoggedIn()) {
        $image = new image();
        $filename = input::get('image');
        $name = input::get('user');
        if (input::get('comment')) {
                $text = input::get('comment');
                try {
                    $image->add_comment($filename, $name, $text);
                    if ($user->data()->comment_email) {
                        $validate = new validate();
                        $validate->send_email($user->data()->email, null, null, $name);

                    }
                    redirect::to('index.php');
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
        }

        echo "<div class = 'box column is-5 is-offset-one-quarter'>
                <img src='uploads/".$filename."'/>
                <br />
                </div>";
    ?>
    <div class='box column is-5 is-offset-one-quarter'>
    <form action="" method="post">
    <input type="submit" class="button" style="background-color:#f35588" value="Add Comment"> 
    <textarea name="comment" rows="5" cols="80"></textarea>
</form>
</div>
<?php


}
else {
    session::flash('login to like', 'Please login or register to like or comment on photos');
    redirect::to('index.php');
}
?>