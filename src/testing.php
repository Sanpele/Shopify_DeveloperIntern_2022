<?php

require_once("objects/PersonObj.php");

require_once("DB/db_manager.php");
require_once("DB/SQlite3_DB.php");



/*
    Testing File. Things to test : 

    DB implementation & admin logic effect on DB
*/

function runAllTests() {
    echo "<br> STARTING TESTING <br> <br>";
    // testGetByID();
    // testDeleteByID();
    // testDB();
    testDeleteAll();

    echo "<br> ------------- PASSED ALL TESTS --------------";
}


function testDeleteAll() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $a1 = toArr("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    $a2 = toArr("Colin2", "Colin2/", TRUE, "Waugh2", "******", $_SERVER['REMOTE_ADDR']);
    $a3 = toArr("Colin3", "Colin3/", FALSE, "Waugh3", "******", $_SERVER['REMOTE_ADDR']);
    
    $person1 = PersonObj::newPerson($a1);
    $person2 = PersonObj::newPerson($a2);
    $person3 = PersonObj::newPerson($a3);

    $db->insert($person1);
    $db->insert($person2);
    $db->insert($person3);

    $count = $db->userCount();
    assert($count == 3, "USER COUNT ERROR");
    echo "<br>" . "6 = $count";

    $db->deleteAll();

    $count = $db->userCount();
    assert($count == 0, "USER COUNT ERROR");
    echo "<br>" . "0 = $count";
}

function testDeleteByID() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $a1 = toArr("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    $a2 = toArr("Colin2", "Colin2/", TRUE, "Waugh2", "******", $_SERVER['REMOTE_ADDR']);
    $a3 = toArr("Colin3", "Colin3/", FALSE, "Waugh3", "******", $_SERVER['REMOTE_ADDR']);
    
    $person1 = PersonObj::newPerson($a1);
    $person2 = PersonObj::newPerson($a2);
    $person3 = PersonObj::newPerson($a3);

    $db->insert($person1);
    $db->insert($person2);
    $db->insert($person3);

    $count = $db->userCount();
    assert($count == 3, "USER COUNT ERROR");
    echo "<br>" . "3 = $count";

    $db->delete(2);

    $count = $db->userCount();
    assert($count == 2, "USER COUNT ERROR");
    echo "<br>" . "2 = $count";

    $db->delete(1);
    $db->delete(0);

    $count = $db->userCount();
    assert($count == 0, "USER COUNT ERROR");
    echo "<br>" . "0 = $count";

}

function testGetByID() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $a1 = toArr("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    $a2 = toArr("Colin2", "Colin2/", TRUE, "Waugh2", "******", $_SERVER['REMOTE_ADDR']);
    $a3 = toArr("Colin3", "Colin3/", FALSE, "Waugh3", "******", $_SERVER['REMOTE_ADDR']);

    // echo "<br>"; 
    // print_r ($a1);
    // echo "<br>"; 
    // print_r ($a2);
    // echo "<br>";
    // print_r ($a3);
    
    $person1 = PersonObj::newPerson($a1);
    $person2 = PersonObj::newPerson($a2);
    $person3 = PersonObj::newPerson($a3);

    $db->insert($person1);
    $db->insert($person2);
    $db->insert($person3);

    $r1 = $db->getByID(0);
    $r2 = $db->getByID(1);
    $r3 = $db->getByID(2);

    assert($r1->getID() == 1, "CHECKING getByID(0) == 0");
    assert($r2->getID() == 1, "CHECKING getByID(1) == 1");
    assert($r3->getID() == 2, "CHECKING getByID(2) == 2");

    $count = $db->userCount();
    echo "<br>" . "COUNT = $count";
    // $db_ctl->resetDB();
}

function testDB() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $a1 = toArr("Colin", "Colin/", TRUE, "Waugh", "*****", $_SERVER['REMOTE_ADDR']);
    $a2 = toArr("Colin2", "Colin2/", TRUE, "Waugh2", "******", $_SERVER['REMOTE_ADDR']);
    $a3 = toArr("Colin3", "Colin3/", FALSE, "Waugh3", "******", $_SERVER['REMOTE_ADDR']);

    echo "<br>" . $a1;
    echo "<br>" . $a2;
    echo "<br>" . $a3;
    
    $person = PersonObj::newPerson($a1);
    $person2 = PersonObj::newPerson($a2);
    $person3 = PersonObj::newPerson($a3);


    echo "<br>" . $person;
    echo "<br>" . $person2;
    echo "<br>" . $person3;

    echo "<br>" . "___________________________TESTING___________________________";

    $db->insert($person);
    $db->insert($person2);
    $db->insert($person3);

    echo "<br>" . "___________________________ATTEMPITNG TO GET RESULTS_________________";

    $persons = $db->getAllPublic();

    foreach ($persons as $curr) {
        echo "<br>";
        echo $curr;
    }

    $count = $db->userCount();
    echo "<br>" . "COUNT = $count";

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