<?php

require_once("DB/db_manager.php");
require_once("DB/SQlite3_DB.php");
require_once("render.php");
require_once("objects/PersonObj.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

/*
    checks cookies to verify is a user is logged in
*/
function checkCookie() {

    print_r($_COOKIE);

    $uname = $_COOKIE['uname']; 
    if (!empty($uname)) {   

        $db_ctl = new db_manager();
        $db = $db_ctl->getDB();
        $person = $db->getByHash($uname);

        if ($person !== NULL) {
            $_SESSION['user_is_loggedin'] = 1;
            $_SESSION['cookie'] = $uname;
            return TRUE;
        }
        else
            echo "<br> COOKIE EXISTS BUT NOT FOUND IN DB";
    }
    else {
        echo "<br> NO COOKIE FOUND";
    }
    return FALSE;
}

function printUserInfo() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $person = NULL;
    if (isset($_SESSION['username']) AND $_SESSION['username'] !== "guest") {
        $user = $_SESSION['username'];
        $person = $db->getByName($user);
    }

    printInfo($person);
}


/*
    Checks DB for user-pass combination.
    if in DB display account info / pictures.
    if nay, sign user up.
*/
function trySignIn($user, $pass) {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $user = $_SESSION['username'];
    $person = $db->getByName($user);

    if ($person === NULL) { // not in DB, reject? how to sign up...setperate page???....???...
        // ASK USER IF THEY WANT TO SIGN UP?
        $_SESSION['login_msg'] = "Im sorry, you don't seem to exist. Why not try signing up with a new acount?";
        $_SESSION['sign_up'] = 1;
        
        header("Location: index.php");
    }
    
    else { // Person Exists, log in

        $_SESSION['username'] = $user; // set username
        $_SESSION['logged_in'] = 1; // log user in on reload
        $_SESSION['public'] = 1; // display all public images on reload

        header("Location: index.php");

    }

}

function displayPics() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();
    $all_people = $db->getAllPublic();

    // print_r($_SESSION);

    if (isset($_SESSION['public']) AND $_SESSION['public'] === 1) {
        echo "<br> PRINTING ALL IMAGES";
        $all_people = $db->getAllPublic();

        $array_of_dir = array();

        // loop over all public people in DB and add the dir to a
        foreach ($all_people as $person) {
            $array_of_dir[] = $person->getPicDir();
        }

        printImages($array_of_dir);
    }
    else {
        echo "<br> PRINTING JUST YOUR IMAGES";

        $user = $_SESSION['username'];
        $person = $db->getByName($user);

        if ($person === NULL) { // error, person we operating on not in DB, this should never be reached
            echo "<br>BIG ERROR, WE THE PERSON FOUND IN THE SESSION VARIABLE IS NOT IN OUR DB, THAT DOSEN't MAKE MUCH SENSE";
        }
        else {
            printImages(array($person->getPicDir()));
        }

    }
}

?>