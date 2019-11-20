<br>
<br>
<br>
<?php
require_once '../init.php';



            $image =  new image();
            $id = input::get('image');
                    try {
                        $name = '../uploads/' . $id;
                        unlink($name);
                        $image->delete($id);
                        session::flash('image delete success', 'Image deleted successfully');
                        redirect::to('../profile_page.php');
                    }
                    catch (Exception $e) {
                        echo "oop";
                        die ($e->getMessage());
                    }

