
<?php
    require_once 'init.php';
    $user = new user();
    if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="#"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="logout.php">Logout</a></li>
    </ul>
    <?php

    } else {
        echo '<p>You need to <a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
    }
    


    
    

