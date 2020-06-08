<?php
require_once 'init.php';
include_once("includes/header.html");
$user = new user();
if (!$user->isLoggedIn()){
    session::flash('login to like', 'Please login or register to like or comment on photos');
    redirect::to('../index.php');
} else {

    $imageURL = input::get('image');
    $id = input::get('id');
    echo "<div class='row justify-content-md-center'>
    <div class='card mt-3'  style='width: 30rem; style='margin-top: 120px;'>
        <div class='card-header' style='background-color:#FFF; margin-top: 120px;'>
        <p class='text-secondary'style='text-align:left; font-size: 35px;'>
        <a href='edit_image_page.php?image=".$imageURL."'><i class='fas fa-edit' style='color:#FFB3BA;'></i></a>
        <span style='float:right;'><a href='functions/delete_image.php?image=".$imageURL."'><i class='fas fa-trash' style='color:#FFB3BA;'></i></a></span>
        </p>
        </div>

        <div class='card-body' style='background-color:#FFF;'>
            <img src='uploads/".$imageURL."' class='card-img-top'>
        </div>
    </div>
</div>";
}