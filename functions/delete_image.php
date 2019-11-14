<?php
require_once '../init.php';



            $image =  new image();
            $id = input::get('image');
                    try {
                        $image->delete($id);
                        session::flash('image delete success', 'Image deleted successfully');
                        redirect::to('../profile_page.php');
                    }
                    catch (Exception $e) {
                        echo "oop";
                        die ($e->getMessage());
                    }

