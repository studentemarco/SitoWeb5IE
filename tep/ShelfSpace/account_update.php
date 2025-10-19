<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $utenti = json_decode(file_get_contents("./accesso/utenti.json"));
    
    if (!isset($_POST["username"]) || !isset($_POST["current_password"]) || !isset($_POST["new_password"]) || !isset($_POST["confirm_password"]) || empty(trim($_POST["username"])) || empty(trim($_POST["current_password"])) || empty(trim($_POST["new_password"])) || empty(trim($_POST["confirm_password"]))) {
        if (!isset($_POST["username"]) || empty(trim($_POST["username"]))) {
            header("Location: account.php?errore=Compila il campo username");
            exit();
        } else{
            // Se si vuole cambiare solo il nome utente
            checkUsername($utenti);
            foreach ($utenti as $utente) {
                if ($utente->username === $_SESSION["name"]) {
                    $utente->username = trim($_POST["username"]);
                    $_SESSION["name"] = $utente->username;
                    break;
                }
            }
            file_put_contents("./accesso/utenti.json", json_encode($utenti));
            header("Location: account.php?successo=Modifica avvenuta con successo");
            exit();
        }
        header("Location: account.php?errore=Compila tutti i campi");
        exit();
    }


    checkUsername($utenti);

    // Aggiorna username e password
    foreach ($utenti as $utente) {
        if ($utente->username === $_SESSION["name"]) {
            // Verifica password attuale
            $salt = substr($utente->password, 0, 32); // Assuming salt is the first 32 characters
            $pepper = trim(file_get_contents("./accesso/pepper.txt"));
            $hashedCurrentPassword = $salt . hash("sha256", (trim($_POST["current_password"])) . $salt . $pepper);
            if ($utente->password !== $hashedCurrentPassword) {
                header("Location: account.php?errore=Password attuale errata");
                exit();
            }
            // Verifica che le nuove password corrispondano
            if (trim($_POST["new_password"]) !== trim($_POST["confirm_password"])) {
                header("Location: account.php?errore=Le nuove password non corrispondono");
                exit();
            }
            // Aggiorna username
            $utente->username = trim($_POST["username"]);
            // Aggiorna password
            $newSalt = bin2hex(random_bytes(16));
            $utente->password = $newSalt . hash("sha256", (trim($_POST["new_password"])) . $newSalt . $pepper);
            // Aggiorna sessione
            $_SESSION["name"] = $utente->username;
            break;
        }
    }

    file_put_contents("./accesso/utenti.json", json_encode($utenti));

    header("Location: account.php?successo=Modifica avvenuta con successo");
    exit();

    function checkUsername($utenti){
        foreach ($utenti as $utente) {
        if (!($_SESSION["name"] === $utente->username) && $utente->username === trim($_POST["username"])) {
            error_log("Username già esistente");
            header("Location: account.php?errore=Username gia esistente");
            die();
        }
        }
    }
?>