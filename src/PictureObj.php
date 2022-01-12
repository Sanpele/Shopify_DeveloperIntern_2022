<?php

class PictureObj {

    private static $num_picture = 0;

    private $id;
    public $name;
    public $parent_directory;
    private $size;
    private $poster;

    public function __construct($in_name, $in_parent_dir, $in_size, $in_poster) {
        $this->id = self::$num_picture;
        self::$num_picture++;
        
        $this->name = $in_name;
        $this->parent_directory = $in_parent_dir;
        $this->size = $in_size;
        $this->poster = $in_poster;
    }

    public function __toString() {
        $format = " <br>
        id          = %s<br>
        name        = %s<br>
        parent_dir  = %s<br>
        size        = %d MB<br>
        poster      = %s<br>
        ---------------------------------------";

        $out = sprintf($format, $this->id, $this->name, $this->parent_directory, $this->size, $this->poster);
        return $out;
    }

}

?>