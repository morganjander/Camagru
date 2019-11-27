<?php
require_once 'init.php';
include_once("includes/footer.html");
$user = new user();
$ask = 0;

if (!$user->isLoggedIn()){
    redirect::to('index.php');
}
if (session::exists('temp_image')) {
    $imageURL = session::get('temp_image');
    session::delete('temp_image');
    $ask = 1;
} else if (session::exists('old_image')){
    $imageURL = session::get('old_image');
} else {
    $imageURL = input::get('image');
}
?>
<br>
<br>
<br> <?php

echo "<div class = 'box column has-text-centered is-6 is-offset-3'>
<img src='uploads/".$imageURL."'/>
<br />
</div>";
if ($ask) {
    ?>
    <div class = 'box column has-text-centered is-6 is-offset-3'>
    <h3>Keep changes?</h3> 
    <form action='functions/edit_image.php' method='post'>
    <input type='submit' name='Yes' value='Yes' class='button' style='background-color:#f35588'>
    <input type='submit' name='No' value='No' class='button' style='background-color:#f35588'>
    </form>
<br />
</div>
<?php
}
?>
<div class = "box column has-text-centered is-6 is-offset-3">
<h3>Add a border</h3> 
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=1.png'><img src="http://localhost/Camagru/borders/1.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=2.png'><img src="http://localhost/Camagru/borders/2.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=3.png'><img src="http://localhost/Camagru/borders/3.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=6.png'><img src="http://localhost/Camagru/borders/6.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=5.png'><img src="http://localhost/Camagru/borders/5.png" height="125" width="125"></a>
</div>
<br>
<br>
<br>