<?php
require_once '../init.php';
$user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('index.php');
    }
?>
<br>
<br>
<br>
<br>
<?php
    $image =  new image();
    if (input::get('image')) {
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            $targetDir = "../uploads/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $timestamp = strtotime('now');
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                
                    try {
                        $image->upload(array(// Insert image file name into database
                            'filename' => $fileName,
                            'username' => session::get('user'),
                            'date_uploaded' => date('m/d/Y h:i:sa', $timestamp),
                            'likes' => 0
                        ));
                        session::flash('image upload success', 'Image upload successful');
                        redirect::to('../upload_page.php');
                    }
                    catch (Exception $e) {
                        die ($e->getMessage());
                    }
                
                }
            }   
    } 
        if (input::get("image1")) {
        $img = $_POST["image1"];
        $folderPath = "../uploads/";
  
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
  
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        echo $fileName;
  
        $file = $folderPath . $fileName;
        if (file_put_contents($file, $image_base64)) {
        $timestamp = strtotime('now');
        try {
            $image->upload(array(// Insert image file name into database
                'filename' => $fileName,
                'username' => session::get('user'),
                'date_uploaded' => date('m/d/Y h:i:sa', $timestamp),
                'likes' => 0
            ));
            session::flash('image upload success', 'Image upload successful');
            redirect::to('../upload_page.php');
        }
        catch (Exception $e) {
            die ($e->getMessage());
        }
    } else {
        echo "couldn't move file";
    }
}

   session::flash('no file', 'Please choose a file to upload');
   redirect::to('../upload_page.php');


