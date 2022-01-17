<?php


/*
    checks cookies to verify is a user is logged in
*/
function checkCookie() {

    $_SESSION['error_msg'] = "INVALID OR EMPTY INPUT";


    return FALSE;
}


/*
    Checks DB for user-pass combination.
    if in DB display account info / pictures.
    if nay, sign user up.
*/
function trySignIn($user, $pass) {



}

function displayPics() {

    

    if (isset($_SESSION['public']) AND $_SESSION['public'] === TRUE) {

    }
    else {

    }
}

?>