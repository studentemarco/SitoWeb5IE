<?php

require 'accesso/usersdata.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["name"])){
    header("location: accesso/accedi.php");
    exit();
}

$list = $_SESSION["userdata"]->libriLetti;

// var_dump($list);

$_SESSION["listToView"] = $list;
$_SESSION["listSender"] = "libri_letti.php";
$_SESSION["accessLV"] = true;

header("location: listviewer.php?listName=Libri Letti");
?>