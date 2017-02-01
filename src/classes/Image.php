<?php
class Image {
    public $path;
    public $image;
    public $width;
    public $height;
    public $simage;
    public $saved;

    public function __construct($path) {
        $this->path = $path;
        $this->image = imagecreatefromjpeg($path);
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
            imagejpeg($this->simage, $path);
        } else {
            imagejpeg($this->image, $path);
        }
        $this->saved = TRUE;
    }

    public function destroy() {
        imagedestroy($this->image);
        imagedestroy($this->simage);
    }
}