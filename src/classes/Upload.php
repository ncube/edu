<?php 
class Upload {
    
    // TODO: Config support and Update Error Handling
    public function profilePic($files) {
        $max_size = 300 * 1025;
        $path = 'data/images/profile/';
        if ((!empty($files["uploaded_file"])) && ($files['uploaded_file']['error'] == 0)) {

            $filename = basename($files['uploaded_file']['name']);
            $ext = substr($filename, strrpos($filename, '.') + 1);
            $filename = md5(mt_rand());

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $files['uploaded_file']['tmp_name']);

            $allowed_ext = array('jpg', 'JPG');
            $allowed_type = array('image/jpeg');

            if (in_array($ext, $allowed_ext) && in_array($type, $allowed_type) && ($files["uploaded_file"]["size"] < $max_size)) {
                $newname = $path.$filename.'.'.$ext;
                DB::updateIf('user', array('profile_pic' => $filename), array('user_id' => Session::get('user_id')));
                if (!file_exists($newname)) {
                    if ((move_uploaded_file($files['uploaded_file']['tmp_name'], $newname))) {
                        echo "Successfully Uploaded!";
                    } else {
                        echo "Error: A problem occurred during file upload!";
                    }
                } else {
                    echo "Error: File ".$files["uploaded_file"]["name"]." already exists";
                }
            } else {
                echo "Error: Only .jpg images under 300Kb are accepted for upload";
            }
        } else {
            echo "Error: No file uploaded";
        }
    }
}