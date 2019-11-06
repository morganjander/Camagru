<?php
require_once 'init.php';
print_r($_SESSION);
echo session::flash('updated');
$user = new user();
if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="#"><?php echo escape($user->data()->username);?> </a></p>
    <ul>
    <li><a href="update.php">Change Username</a></li>
    <li><a href="password_reset.php">Change Password</a></li>
    <li><a href="logout.php">Logout</a></li>
    </ul>
    <?php

    } else {
        echo '<p>You need to <a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
    }