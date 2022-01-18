<?php

require_once("DB/db_manager.php");
require_once("DB/SQlite3_DB.php");

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

if (isset($_POST['username']) AND isset($_POST['password']) AND $_POST['username'] !== "" AND $_POST['password'] !== "") {

    $db = getDB();

    $user_ip = $_SERVER['REMOTE_ADDR'];

    $cookie_hash = md5(sha1($_POST['username'] . $user_ip));

    if(setcookie("uname",$cookie_hash,time()+3600*24*365,'/'))
        echo "<br> COOKIE WORKED";
    else
        echo "<br> COOKIE FAILED";
    
    $person_arr = toArr($_POST['username'], $_POST['username'] . '/', FALSE, $_POST['password'], $cookie_hash, $user_ip);
    $new_person = PersonObj::newPerson($person_arr);
    $db->insert($new_person);

}

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