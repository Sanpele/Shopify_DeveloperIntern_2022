<?php

require_once("PersonObj.php");
require_once("PictureObj.php");

require_once("db_manager.php");
require_once("SQlite3_DB.php");

/*
    Testing File. Things to test : 

    DB implementation & 
    admin logic effect on DB
*/

function runAllTests() {

    echo "<br> STARTING TESTING <br> <br>";
    testDB();

}

function testDB() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $person = new PersonObj("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    $person2 = new PersonObj("Colin2", "Colin2/", TRUE, "Waugh2", "******", $_SERVER['REMOTE_ADDR']);
    $person3 = new PersonObj("Colin3", "Colin3/", FALSE, "Waugh3", "******", $_SERVER['REMOTE_ADDR']);


    echo "<br>" . $person;
    echo "<br>" . $person2;
    echo "<br>" . $person3;

    echo "<br>" . "___________________________TESTING___________________________";

    $db->insert($person);
    $db->insert($person2);
    $db->insert($person3);

    echo "<br>" . "___________________________ATTEMPITNG TO GET RESULTS_________________";

    $db->getAllPublic();

    $count = $db->userCount();

    echo "<br>" . "COUNT = $count";

    $db_ctl->resetDB();

}

function test_personObj() {

    $person = new PersonObj("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    echo "<br>" . $person;    
}

function test_pictureObj() {

    $picture1 = new PictureObj("p123", "colin/", FALSE, 23, "Colin");
    echo "<br>" . $picture1;
}

?>