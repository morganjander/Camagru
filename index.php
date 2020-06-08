
<?php
    require_once 'init.php';
    include_once("includes/header.html");
    include 'functions/display_all_photos.php';
    $user = new user();
    if ($user->isLoggedIn()) {
        include_once("includes/footer.html");
    } else {
        include_once("includes/footer logged_out.html");
    }
    display_all_photos();

    if (session::exists('verified')) {
        echo "<br>
    <br>
    <br>";
        echo session::flash('verified');
    }
    if (session::exists('error')) {
        echo "<br>
    <br>
    <br>";
        echo session::flash('error');
    }
    if (session::exists('login to like')) {
        echo "<br>
    <br>
    <br>";
        echo session::flash('login to like');
    }
    if (session::exists('login to upload')) {
        echo "<br>
    <br>
    <br>";
        echo session::flash('login to upload');
    }
    
    


    
    

