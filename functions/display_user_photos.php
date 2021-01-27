<?php
function display_user_photos($user){
    $image = new image();
    $name = new user();
    
    $photos = $image->get_all_user_photos($user);
    $photos = $photos->results();
    echo "
    <hr class='mt-2 mb-5'>
    <div class='row text-center text-lg-left' style='margin-top: 12px; margin-bottom: 120px;'>";
    if($photos){

        foreach ($photos as $photo) {
            $imageURL = $photo->filename;
            if ($name->find($photo->user_id)) {
                $uploader = $name->data()->username;
            }
            $id = $photo->id;
        echo "

          <div class='col-lg-3 col-md-7 col-8' >
            <a href='display_photo.php?image=".$imageURL."&id=".$id."' class='d-block mb-1 h-10'>
                  <img style='height:250px; width:250px; object-fit: cover;' class='img-fluid img-thumbnail' src='uploads/".$imageURL."'>
                </a>
          </div>";
        }
        echo "</div>";
    }   
}
