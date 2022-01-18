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
            // reset expiry date
            setcookie("uname",$uname,time()+3600*24*365,'/');
        }
        else
            echo "<br> COOKIE EXISTS BUT NOT FOUND IN DB";
    }
    else {
        echo "<br> NO COOKIE FOUND";
    }


    return FALSE;
}


/*
    Checks DB for user-pass combination.
    if in DB display account info / pictures.
    if nay, sign user up.
*/
function trySignIn($user, $pass) {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

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

        setcookie("uname",$person->getPassHash(),time()+3600*24*365,'/'); // this is lazy, should recalcuate user pass hash and update them
        header("Location: index.php");

    }

}

function displayPics() {

    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();
    $all_people = $db->getAllPublic();

    print_r($_SESSION);
    if (isset($_SESSION['public']) AND $_SESSION['public'] === 1) {
        $all_people = $db->getAllPublic();
        printImages($all_people);
    }
    else {
        $one = array();
    }
}

?>