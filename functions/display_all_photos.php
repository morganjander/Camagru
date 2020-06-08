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
        echo "<div style='margin-top: 120px; margin-bottom: 120px;'>";
        foreach ($photos->results() as $photo) {
            $imageURL = $photo->filename;
            if ($name->find($photo->user_id)) {
                $uploader = $name->data()->username;
            }
            
            $likes = $photo->likes;
            $id = $photo->id;
            $comments = $image->get_all_comments($id);
        
        echo "<div class='row justify-content-md-center'>
                <div class='card mt-3'  style='width: 30rem;'>
                    <div class='card-header' style='background-color:#FFB3BA;'>
                        <p class='text-secondary'style='text-align:left;'>$uploader";
                        if ($likes == 1) {
                            echo "<span style='float:right;'>
                            $likes like
                            </span>";
                        } else {
                            echo "<span style='float:right;'>
                            $likes likes
                            </span>";
                        }
                echo  "</p>
                    </div>
            
                    <div class='card-body' style='background-color:#FFF;'>
                        <img src='uploads/".$imageURL."' class='card-img-top'>
                        <p class='text-secondary'style='text-align:right; font-size: 35px;'>
                            <a href='functions/add_like.php?image=".$imageURL."'><i class='far fa-heart' style='color:#FFB3BA;'></i></a>
                        </p>
                        <p class='text-secondary'style='text-align:left;'>";
                        if ($comments->results()) {
                            foreach ($comments->results() as $comment) {
                                if ($name->find($comment->user_id)) {
                                    $commenter = $name->data()->username;
                                }
                                echo "<i class='far fa-comment' style='color:#FFB3BA;'></i>" . " " . $commenter . ": ". $comment->comment_text . "<br>";
                            }
                        }
                echo  "  </p>
                        <div class='form-group'>
                            <form action='./functions/add_comment.php?image=".$imageURL."' method='post'>
                            <textarea name='comment' class='form-control' rows='1' id='comment' placeholder='Write comment...'></textarea>
                            <br>
                            <span style='float:right;'><button type='submit' class='btn btn-default'>Post</button></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
            
        }
        echo "</div>";
    }   
}
