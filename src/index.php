<?php

require_once("testing.php");
require_once("render.php");
require_once("admin.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

echo "<br><p> Hello There";

$testing = FALSE;

function load_main_page() {

    printHeader();


    if (!$testing) {     // RENDER IMG REPO HTML

        // echo "<br>LOGIN :" . $_SESSION['error_msg'];

        if (isset($_SESSION['error_msg']))
            echo "<br>" . $_SESSION['error_msg'];

        if (checkCookie()) {
            
        }
        else {
            printSignIn();
        }

    } 
    else {              // RUN TEST CODE
        runAllTests();
    }

    printFooter();

}

load_main_page();

?>