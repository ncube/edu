<?php
class Image {
    public $path;
    public $image;
    public $width;
    public $height;
    public $simage;
    public $saved;

    public function __construct($path, $type) {
        $this->path = $path;
        $this->type = $type;

        switch ($type) {
            case 'image/png':
                $this->image = imagecreatefrompng($path);
                break;

            case 'image/jpeg':
                $this->image = imagecreatefromjpeg($path);
                break;

            default:
                $this->errors = 'Unknown format';
                break;
        }
        $this->simage = NULL;
        $this->saved = FALSE;
        list($this->width, $this->height) = getimagesize($path);;
    }

    public function crop($x, $y, $width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->image = imagecrop($this->image, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
    }

    public function scale($width, $height) {
        $this->simage = imagecreatetruecolor($width, $height);
        imagecopyresampled($this->simage, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
    }

    public function save($path) {
        if ($this->simage !== NULL) {
            imagejpeg($this->simage, $path.'.jpg');
        } else {
            imagejpeg($this->image, $path.'.jpg');
        }
        $this->saved = TRUE;
    }

    public function destroy() {
        imagedestroy($this->image);
        imagedestroy($this->simage);
    }
}