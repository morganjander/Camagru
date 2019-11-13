
<?php
    require_once 'init.php';
    include 'functions/display_all_photos.php';
    $user = new user();
    display_all_photos();
    
    if (session::exists('verified')) {
        echo session::flash('verified');
    }
    if (session::exists('error')) {
        echo session::flash('error');
    }
    if (session::exists('login to like')) {
        echo session::flash('login to like');
    }
    if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="profile_page.php"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="functions/logout_user.php">Logout</a></li>
    </ul>
    
    <?php
    

    } else {
        echo '<p><a href="login_page.php">Log in</a> or <a href="register_page.php">Register</a></p>';
    }
    


    
    

