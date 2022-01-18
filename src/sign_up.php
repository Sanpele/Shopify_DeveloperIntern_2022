<?php

require_once("DB/db_manager.php");
require_once("DB/SQlite3_DB.php");
require_once("objects/PersonObj.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

if (isset($_POST['username']) AND isset($_POST['password']) AND $_POST['username'] !== "" AND $_POST['password'] !== "") {

    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);


    $db_ctl = new db_manager();
    $db = $db_ctl->getDB();

    $user_ip = $_SERVER['REMOTE_ADDR'];

    $cookie_hash = md5(sha1($user. $user_ip));

    if(setcookie("uname",$cookie_hash,time()+3600*24*365,'/'))
        echo "<br> COOKIE WORKED";
    else
        echo "<br> COOKIE FAILED";
    
    $person_arr = toArr($user, $user . '/', FALSE, $pass, $cookie_hash, $user_ip);
    $new_person = PersonObj::newPerson($person_arr);
    echo($new_person);
    print_r($new_person);

    $count = $db->userCount();
    echo "<br> Count = " . $count;

    $db->insert($new_person);

    $count = $db->userCount();
    echo "<br> Count = " . $count;

    $_SESSION['username'] = $user; // set username 
    $_SESSION['logged_in'] = 1; // log in on reload
    $_SESSION['public'] = 1; // display public images
    header("Location: index.php");

}
else {
    $_SESSION['error_msg'] = "Your username/password was not allowed, please try again";
    header("Location: index.php");
}

$_SESSION['sign_up'] = 0;

function toArr($name, $dir, $privacy, $pass, $hash, $ip) {

    $arr = array();
    $arr['id'] = PHP_INT_MAX;
    $arr['username'] = $name;
    $arr['pic_directory'] = $dir;
    $arr['privacy'] = $privacy;
    $arr['space_quota'] = 200;
    $arr['password'] = $pass;
    $arr['pass_hash'] = $hash;
    $arr['ipaddress'] = $ip;

    return $arr;

}


?>