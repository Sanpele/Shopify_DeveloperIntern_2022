<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

$_SESSION['logged_in'] = 0;
print_r($_SESSION);
setcookie("uname",$cookie_hash,time()-3600,'/');

header("Location: index.php");


?>