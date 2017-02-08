<?php 
class Upload {
    public $name;
    public $uploaded;
    public $errors;
    public $path;

    public function __construct() {
        $this->name = NULL;
        $this->path = NULL;
        $this->type = NULL;
        $this->uploaded = FALSE;
        $this->errors = FALSE;
    }
    
    // TODO: Config support and Update Error Handling
    public function profilePic($files) {
        $max_size = 5000 * 1024;
        $path = 'data/images/profile/original/';
        if ((!empty($files["uploaded_file"])) && ($files['uploaded_file']['error'] == 0)) {

            $filename = basename($files['uploaded_file']['name']);
            $ext = substr($filename, strrpos($filename, '.') + 1);
            $filename = md5(mt_rand());

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $files['uploaded_file']['tmp_name']);

            $allowed_ext = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG');
            $allowed_type = array('image/jpeg', 'image/png');

            if (in_array($ext, $allowed_ext) && in_array($type, $allowed_type) && ($files["uploaded_file"]["size"] < $max_size)) {
                $ext = strtolower($ext);
                $newname = $path.$filename;
                $this->name = $filename;
                $this->path = $newname;
                $this->type = $type;
                $db = DB::connect();
                $db->updateIf('user', array('profile_pic' => $filename), array('user_id' => Session::get('user_id')));
                if (!file_exists($newname)) {
                    if ((move_uploaded_file($files['uploaded_file']['tmp_name'], $newname))) {
                        $this->uploaded = TRUE;
                    } else {
                        $this->errors = "Error: A problem occurred during file upload!";
                    }
                } else {
                    $thid->errors = "Error: File ".$files["uploaded_file"]["name"]." already exists";
                }
            } else {
                $this->errors = "Error: Only .jpg & .png images under 5Mb are accepted for upload";
            }
        } else {
            $this->errors = "Error: No file uploaded";
        }
    }
}