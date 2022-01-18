<?php

require_once("admin.php");
require_once("index.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

if (isset($_POST['username']) AND isset($_POST['password']) AND $_POST['username'] !== "" AND $_POST['password'] !== "") {
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);

    $_SESSION['logged_in'] = TRUE;

    trySignIn($user, $pass);

    header("Location: index.php");

    echo "<br>User = $user, Pass = $pass";
}
else {
    echo "<br>Sign In Failed, Refresh to try again";
    $_SESSION['error_msg'] = "INVALID OR EMPTY INPUT";
    header("Location: index.php");
}

?>