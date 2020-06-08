<?php
 require_once '../init.php';
 $user = new user();
 $user->logout();
 redirect::to('../login_page.php');
