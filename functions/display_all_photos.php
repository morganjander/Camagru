<?php
function display_all_photos(){
    $image = new image();
    $photos = $image->get_all_photos();
    
    if($photos->results()){

        foreach ($photos->results() as $photo) {
            $imageURL = $photo->filename;
            $uploader = $photo->username;
            $likes = $photo->likes;
            $id = $photo->id;
            $text = "";
            $comments = $image->get_all_comments($id);
            if ($comments->results()) {
                foreach ($comments->results() as $comment) {
                    $text .= $comment->username . ": ". $comment->comment_text . "<br>";
                }
            }
        
        
            echo "<div class = 'box column is-5 is-offset-one-quarter'>
            <img src='uploads/".$imageURL."'/>
            <br />
            <h4 class='subtitle is-5 has-text-right'><p style='color:#f35588'>$uploader $likes <a href='functions/add_like.php?image=".$imageURL."'><img width=35 height=30 src='images/like_icon.png'/></a></p></h4>
            <h4 class='subtitle is-5 has-text-left'><a href='add_comment.php?image=".$imageURL."'><img width=35 height=30 src='images/comment_icon.png'/></a></h4>
            <h4 class='subtitle is-7 has-text-left'><p>$text</p></h4>
            </div>";
            
        }
    }   
     else{ 
        ?><p>No image(s) found...</p> <?php
    }
}
