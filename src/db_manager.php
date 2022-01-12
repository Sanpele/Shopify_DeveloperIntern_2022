<?php 

require_once("SQlite3_DB.php");

class db_manager {

    private static $db;

    public function __construct() {
        $db = NULL;
    }

    public function getDB() { // enforce singleton pattern on DB
        if (self::$db == NULL) {
            self::$db = new sqlite_imp();
            return self::$db;
        }
        else {
            return self::$db;
        }
    }

}

?>