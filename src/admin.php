<?php

require_once("DB/db_manager.php");
require_once("DB/SQlite3_DB.php");
require_once("render.php");


/*
    checks cookies to verify is a user is logged in
*/
function checkCookie() {

    $uname = $_COOKIE['uname']; 
    if (!empty($uname)) {   

        $sql = "SELECT * FROM `users` WHERE `login_session`='$uname'";
        
        $_SESSION['user_is_loggedin'] = 1;
        $_SESSION['cookie'] = $uname;
        // reset expiry date
        setcookie("uname",$uname,time()+3600*24*365,'/');
    }

    return FALSE;
}


/*
    Checks DB for user-pass combination.
    if in DB display account info / pictures.
    if nay, sign user up.
*/
function trySignIn($user, $pass) {

    $db = getDB();

    $person = getByName($user);
    if ($person === NULL) { // not in DB, reject? how to sign up...setperate page???....???...
        // ASK USER IF THEY WANT TO SIGN UP?
        printSignUp();
    }
    

}

function displayPics() {

    $db = getDB();

    if (isset($_SESSION['public']) AND $_SESSION['public'] === TRUE) {
        $all_people = $db->getAllPublic();
        printImages($all_people);
    }
    else {

    }
}

?>