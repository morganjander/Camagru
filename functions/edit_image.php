<?php
require_once '../init.php';
?>
<br>
<br>
<br> <?php

$image = input::get('image');
$border = input::get('border');
list($width, $height) = getimagesize('../uploads/'. $image);
$new_width = 400;
$new_height = 300;
$ext = pathinfo($image, PATHINFO_EXTENSION);
if ($new_width != $width || $new_height != $height) {
$image_p = imagecreatetruecolor($new_width, $new_height);
    if ($ext === 'png') {
        $dest = imagecreatefrompng('../uploads/'. $image);
    } else {
        $dest = imagecreatefromjpeg('../uploads/'. $image);
    }
    imagecopyresampled($image_p, $dest, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    $save = '../uploads/'. $image;
    if ($ext === 'png') {
        imagepng($image_p, $save);
    } else {
        imagejpeg($image_p, $save);
    }
    
    imagedestroy($image_p);
}
if ($ext === 'png') {
    $dest = imagecreatefrompng('../uploads/'. $image);
} else {
    $dest = imagecreatefromjpeg('../uploads/'. $image);
}

$src = imagecreatefrompng('../borders/'. $border);

imagecopy($dest, $src, 0, 0, 0, 0, 400, 300); 

$save = '../uploads/'. $image;
imagepng($dest, $save);
imagedestroy($dest);
imagedestroy($src);
redirect::to('../profile_page.php');



?>

    <br>
    <br>
    <br>