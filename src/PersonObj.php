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
    private $pass_hash;
    private $ipaddress;

    public function __construct($in_name, $in_dir, $in_privacy, $in_pass, $in_pass_hash, $in_ip) {
        $this->id = self::$num_person;
        self::$num_person++;

        $this->username = $in_name;
        $this->pic_directory = $in_dir;
        $this->privacy = $in_privacy;
        $this->space_quota = 0; // 200 mb
        $this->password = $in_pass;
        $this->pass_hash = $in_pass_hash;
        $this->ipadress = $in_ip;
    }

    public function getPrivacy() {
        return $this->privacy;
    }

    public function getPassHash() {
        return $this->pass_hash;
    }

    public function getPass() {
        return $this->password;
    }

    public function addQuota($additional_space) {
        // only update if have room. 
        if ($additional_space + $this->space_quota < $self::$allowed_mb)
            $this->space_quota += $additional_space;
    }
    
    public function getQuota() {
        return $this->space_quota;
    }

    public function getPicDir() {
        return $this->pic_directory;
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