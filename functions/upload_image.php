<?php
require_once '../init.php';

if (Input::exists()) {
    if (token::check(input::get('token')) && input::get('file')) {
            $image =  new image();
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            $targetDir = "../uploads/";
            print_r($_FILES);
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                
                    try {
                        $image->upload(array(// Insert image file name into database
                            'user_id' => session::get('user'),
                            'filename' => $fileName,
                            'name' => 'temp',
                            'date_uploaded' => date("Y/m/d")
                        ));
                        session::flash('upload success', 'Upload successful');
                        redirect::to('../profile.php');
                    }
                    catch (Exception $e) {
                        die ($e->getMessage());
                    }
                
                }
            }   
    }
}