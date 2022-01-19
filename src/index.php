<?php

require_once("testing.php");
require_once("render.php");
require_once("admin.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

$testing = FALSE;

function load_picture_page() {
    printHeader();

    echo "<br> You are Logged in ! Hello from the picture page :D";

    printLogout();

    // print user info
    printUserInfo();

    // display all user pics
    displayPics();


    // print pictures

    printFooter();
}

function load_menu_page() {
    printHeader();

    if (checkCookie()) {
        load_picture_page();
    }
    else {
        printSignIn();
    }

    printFooter();
}

function load_sign_up() {
    printHeader();

    printSignUp();

    printFooter();

}

if ($testing) { // run testing code
    runAllTests();
}
else {

    if (isset($_SESSION['clr_cookie']) AND $_SESSION['clr_cookie'] === 1) {
        // print_r($_SESSION);
        // echo "<br>";
        // print_r($_COOKIE);
        // echo "<br>";
        unset($_COOKIE['uname']);
        unset($_SESSION['cookie']);
        // print_r($_SESSION);
        // echo "<br>";
        // print_r($_COOKIE);
        $_SESSION['clr_cookie'] = 0;
    }


    // not signed in and wants to 
    if ((!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] === 0) AND isset($_SESSION['sign_up']) AND $_SESSION['sign_up'] === 1) {
        load_sign_up();
    }
    // print_r($_SESSION);
    else if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] === 0)
        load_menu_page();
    else 
        load_picture_page();
}
?>