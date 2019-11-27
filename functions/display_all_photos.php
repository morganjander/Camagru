<?php
function display_all_photos($user = null){
    $image = new image();
    $name = new user();
    if ($user) {
        $photos = $image->get_all_user_photos($user);
    }
    else {
        $photos = $image->get_all_photos();
    }
    
    if($photos->results()){

        foreach ($photos->results() as $photo) {
            $imageURL = $photo->filename;
            if ($name->find($photo->user_id)) {
                $uploader = $name->data()->username;
            }
            
            $likes = $photo->likes;
            $id = $photo->id;
            $text = "";
            $comments = $image->get_all_comments($id);
            if ($comments->results()) {
                foreach ($comments->results() as $comment) {
                    if ($name->find($comment->user_id)) {
                        $commenter = $name->data()->username;
                    }
                    $text .= $commenter . ": ". $comment->comment_text . "<br>";
                }
            }
        
        
            echo "<div class = 'box column is-4 is-offset-one-quarter'>";
            if (!$user) {
            echo "<h4 class='subtitle is-5 has-text-left'><p style='color:#f35588'>$uploader</p></h4>";
            }
            if ($user) {
            echo "<h4 class='subtitle is-5 has-text-right'><p style='color:#f35588'><a href='functions/delete_image.php?image=".$imageURL."'><img width=35 height=30 src='images/delete_icon.png'/></a></p></h4>";
            echo "<h4 class='subtitle is-5 has-text-right'><p style='color:#f35588'><a href='edit_image_page.php?image=".$imageURL."'><img width=35 height=30 src='images/edit_icon.png'/></a></p></h4>";
            }
            echo "<div class='card-content is-flex is-horizontal-center'><img is-centered src='uploads/".$imageURL."'/></div>
            <br />
            <h4 class='subtitle is-5 has-text-right'><p style='color:#f35588'>$likes <a href='functions/add_like.php?image=".$imageURL."'><img width=35 height=30 src='images/like_icon.png'/></a></p></h4>
            <h4 class='subtitle is-5 has-text-left'><a href='add_comment.php?image=".$imageURL."'><img width=35 height=30 src='images/comment_icon.png'/></a></h4>
            <h4 class='subtitle is-7 has-text-left'><p>$text</p></h4>
            </div>";
            
        }
    }   
     else{ 
        ?><p>No images yet</p> <?php
    }
}
