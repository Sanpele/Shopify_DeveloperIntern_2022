<?php

require_once("db_interface.php");

class sqlite_imp implements db_interface {

    private static $db;

    public function __construct() {
        $db = new SQLite3('db.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $db->query('CREATE TABLE IF NOT EXISTS "people" (
            "id" INTEGER PRIMARY KEY NOT NULL,
            "username" VARCHAR,
            "pic_directory" VARCHAR,
            "space_quota" INTEGER,
            "password" VARCHAR,
            "pass_hash" VARCHAR,
            "ipaddress" VARCHAR,
        )');

        return $db;
    }
    public function insert($person) {
        $statement = $db->prepare('INSERT INTO "visits" ("user_id", "url", "time") VALUES (:uid, :url, :time)');
        $statement->bindValue(':uid', 1337);
        $statement->bindValue(':url', '/test');
        $statement->bindValue(':time', date('Y-m-d H:i:s'));
        $statement->execute(); // you can reuse the statement with different values
    }
    public function update($person) {

    }
    public function getByPrivacy() {

    }
    public function getByID($id) {

    }
    public function delete($id) {

    }


}

?>