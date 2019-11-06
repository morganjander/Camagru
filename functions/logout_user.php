<?php
 require_once '../init.php';
 $user = new user();
 $user->logout();
 redirect::to('../index.php');
