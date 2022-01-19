<?php 

require_once("SQlite3_DB.php");

class db_manager {

    private static $db;

    public function __construct() {
        $db = NULL;
    }

    public function getDB() { // singleton pattern on DB
        if (db_manager::$db == NULL) {
            db_manager::$db = new sqlite_imp();
            return db_manager::$db;
        }
        else {
            return db_manager::$db;
        }
    }

    private function resetDB() {
        db_manager::$db = NULL;
        unlink("db.sqlite");
        echo "<br> DB IS DELETED";
    }

}

?>