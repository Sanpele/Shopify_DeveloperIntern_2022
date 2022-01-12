<?php

require_once("PersonObj.php");
require_once("PictureObj.php");

/*
    Testing File. Things to test : 

    DB implementation & 
    admin logic effect on DB
*/

function runAllTests() {

    echo "<br> STARTING TESTING <br> <br>";
    test_personObj();
    test_pictureObj();

}

function test_personObj() {

    $person = new PersonObj("Colin", "Colin/", TRUE, "Waugh", $_SERVER['REMOTE_ADDR']);
    echo "<br>" . $person;    
}

function test_pictureObj() {

    $picture1 = new PictureObj("p123", "colin/", FALSE, 23, "Colin");
    echo "<br>" . $picture1;
}

?>