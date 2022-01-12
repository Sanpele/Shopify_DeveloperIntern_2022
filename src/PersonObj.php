<?php

class PersonObj {

    private static $num_person = 0;
    private static $allowed_mb = 200;

    private $id;
    public $username;
    private $pic_directory;
    private $privacy;

    private $space_quota;
    private $password;
    private $ipaddress;

    public function __construct($in_name, $in_dir, $in_privacy, $in_pass, $in_ip) {
        $this->id = self::$num_person;
        self::$num_person++;

        $this->username = $in_name;
        $this->pic_directory = $in_dir;
        $this->privacy = $in_privacy;
        $this->space_quota = 200; // 200 mb
        $this->password = $in_pass;
        $this->ipadress = $in_ip;
    }

    public function getID() {
        return $this->id;
    }

    public function getIP() {
        return $this->ipadress;
    }

    public function __toString() {
        $format = " <br>
        id          = %s<br>
        username    = %s<br>
        pic_dir     = %s<br>
        space used  = %d%%<br>
        ----------------------------------------";
        $out = sprintf($format, $this->id, $this->username, $this->pic_directory, $this->space_quota / self::$allowed_mb);
        return $out;
    }

}

?>