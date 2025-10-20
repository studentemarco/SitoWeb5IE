<?php

require "accesso/usersdata.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$preferiti = "preferiti";
$letti = "libriLetti";

function addBookToList($isbn, $list) {
    global $preferiti;
    global $letti;

    if ($list == $preferiti)
    {
        if (!in_array($isbn, $_SESSION["userdata"]->preferiti)) {
            $_SESSION["userdata"]->preferiti[] = $isbn;
        }
    } elseif ($list == $letti) {
        if (!in_array($isbn, $_SESSION["userdata"]->libriLetti)) {
            $_SESSION["userdata"]->libriLetti[] = $isbn;
        }
    } else {
        $_SESSION["userdata"]->lists[$list] = $isbn;
    }

    $utente = $_SESSION["userdata"];

    UserData::updateUser($utente);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['ISBN'];
    $list = $_POST['LIST'];

    addBookToList($isbn, $list);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['REMOVE']) && $_POST['REMOVE'] === 'true') {
    $isbn = $_POST['ISBN'];
    $list = $_POST['LIST'];

    if ($list == $preferiti) {
        if (($key = array_search($isbn, $_SESSION["userdata"]->preferiti)) !== false) {
            unset($_SESSION["userdata"]->preferiti[$key]);
            $_SESSION["userdata"]->preferiti = array_values($_SESSION["userdata"]->preferiti);
        }
    } elseif ($list == $letti) {
        if (($key = array_search($isbn, $_SESSION["userdata"]->libriLetti)) !== false) {
            unset($_SESSION["userdata"]->libriLetti[$key]);
            $_SESSION["userdata"]->libriLetti = array_values($_SESSION["userdata"]->libriLetti);
        }
    } else {
        if (isset($_SESSION["userdata"]->lists[$list]) && $_SESSION["userdata"]->lists[$list] === $isbn) {
            unset($_SESSION["userdata"]->lists[$list]);
        }
    }

    $utente = $_SESSION["userdata"];

    UserData::updateUser($utente);

    header('Content-Type: application/json');
    echo json_encode(['message' => 'Book removed from ' . $list]);
    exit();
}


?>