<?php
    require_once 'init.php';
    include_once("includes/footer.html");
    $user = new user();
    if (!$user->isLoggedIn()){
        session::flash('login to like', 'Please login or register to like or comment on photos');
        redirect::to('index.php');
    } else {
        $filename = input::get('image');
        $image = new image();
        $owner = $image->get_photo($filename)->first()->user_id;
        $name = $user->data()->username;
        $recipient = new user();
        if ($recipient->find($owner)) {
            $email = $recipient->data()->email;
        }
        if (input::get('comment')) {
                $text = input::get('comment');
                $text = htmlspecialchars($text);
                try {
                    $image->add_comment($filename, $owner, $text);
                    if ($user->data()->comment_email) {
                        $validate = new validate();
                        $validate->send_email($email, null, null, $name);

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