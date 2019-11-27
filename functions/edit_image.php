<?php
require_once '../init.php';
?>
<br>
<br>
<br>
<?php

if (input::exists('post')) {
    $image = session::get('old_image');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $save = '../uploads/'. $image;
    if ($_POST['Yes']) {
        if ($ext === 'png'){
            $dest = imagecreatefrompng('../uploads/temp.png');
            imagepng($dest, $save);
            unlink('../uploads/temp.png');
        } else {
            $dest = imagecreatefromjpeg('../uploads/temp.jpeg');
            imagejpeg($dest, $save);
            unlink('../uploads/temp.jpeg');
        }       
        session::delete('old_image');
        session::delete('temp_image');
        redirect::to('../profile_page.php');
    }
    if ($_POST['No']) {
        $image = session::get('old_image');
        if ($ext === 'png'){
            $dest = imagecreatefrompng('../uploads/'. $image);
            imagepng($dest, $save);
            unlink('../uploads/temp.png');
        } else {
            $dest = imagecreatefromjpeg('../uploads/'. $image);
            imagejpeg($dest, $save);
            unlink('../uploads/temp.jpeg');
        }
        session::delete('temp_image');
        redirect::to('../edit_image_page.php');

    }
}

$image = input::get('image');
$old_image = session::put('old_image', $image);
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
if ($ext === 'png') {
    $save = '../uploads/temp.png';
    imagepng($dest, $save);
    session::put('temp_image','temp.png');
} else {
    $save = '../uploads/temp.jpeg';
    imagejpeg($dest, $save);
    session::put('temp_image','temp.jpeg');
}


imagedestroy($dest);
imagedestroy($src);
redirect::to('../edit_image_page.php');
