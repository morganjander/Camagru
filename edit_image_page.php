<?php
require_once 'init.php';
$user = new user();
if (!$user->isLoggedIn() || empty($_GET['image'])){
    redirect::to('index.php');
}
?>
<br>
<br>
<br> <?php
$imageURL = input::get('image');
echo "<div class = 'box column has-text-centered is-6 is-offset-3'>
<img src='uploads/".$imageURL."'/>
<br />
</div>";
?>
<div class = "box column has-text-centered is-6 is-offset-3">
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=1.png'><img class="filter" src="http://localhost/Camagru/borders/1.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=2.png'><img class="filter" src="http://localhost/Camagru/borders/2.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=3.png'><img class="filter" src="http://localhost/Camagru/borders/3.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=4.png'><img class="filter" src="http://localhost/Camagru/borders/4.png" height="125" width="125"></a>
<a href='functions/edit_image.php?image=<?php echo "$imageURL";?>&border=5.png'><img class="filter" src="http://localhost/Camagru/borders/5.png" height="125" width="125"></a>
</div>
<br>
<br>
<br>