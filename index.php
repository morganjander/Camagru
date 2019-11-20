
<?php
    require_once 'init.php';
    include 'functions/display_all_photos.php';
?>
<br>
<br>
<br> <?php
    if (session::exists('verified')) {
        echo session::flash('verified');
    }
    if (session::exists('error')) {
        echo session::flash('error');
    }
    if (session::exists('login to like')) {
        echo session::flash('login to like');
    }
    if (session::exists('login to upload')) {
        echo session::flash('login to upload');
    }
    $user = new user();
    if ($user->isLoggedIn()) {
    include_once("includes/footer.html");
    ?>
    <p>Hello <a href="profile_page.php"><?php echo escape($user->data()->username);?> </a></p>
    <?php
    } else {
        echo '<p><a href="login_page.php">Log in</a> or <a href="register_page.php">Register</a></p>';
    }
    display_all_photos();
    ?>
    <br>
    <br>
    


    
    

