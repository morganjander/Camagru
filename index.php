
<?php
    require_once 'init.php';
    require_once 'includes/install.php';
    if (session::exists('verified')) {
        echo session::flash('verified');
    }
    $user = new user();
    if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="profile.php"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="logout.php">Logout</a></li>
    </ul>
    <?php

    } else {
        echo '<p><a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
    }
    


    
    

