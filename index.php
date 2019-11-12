
<?php
    require_once 'init.php';
    
    $user = new user();
    
    if (session::exists('verified')) {
        echo session::flash('verified');
    }
    if (session::exists('error')) {
        echo session::flash('error');
    }
    if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="profile.php"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="logout.php">Logout</a></li>
    </ul>
    
    <?php
    $image = new image();
    $image->display_all();

    } else {
        echo '<p><a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
    }
    


    
    

