
<?php
    require_once 'init.php';
    include_once("includes/header.html");
    include 'functions/display_all_photos.php';
    
    if (session::exists('error')) {
        session::flash('error');
        echo '<script type="text/javascript">alert("Something went wrong");</script>';
    }
    if (session::exists('login to like')) {
        session::flash('login to like');
        echo '<script type="text/javascript">alert("Please login or register to like photos");</script>';
    }
    if (session::exists('login to upload')) {
        session::flash('login to upload');
        echo '<script type="text/javascript">alert("Please login or register to upload photos");</script>';
    }
    if (session::exists('not logged in')) {
        session::flash('not logged in');
        echo '<script type="text/javascript">alert("Please login first");</script>';
    }
    $user = new user();
    if ($user->isLoggedIn()) {
        include_once("includes/footer.html");
    } else {
        include_once("includes/footer logged_out.html");
    }
    display_all_photos();
    
    

