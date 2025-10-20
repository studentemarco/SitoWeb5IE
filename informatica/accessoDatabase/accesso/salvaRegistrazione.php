<?php
    session_start();
    if (!isset($_POST["username"]) || !isset($_POST["password"]) || empty(trim($_POST["username"])) || empty(trim($_POST["password"]))) {
        header("Location: registrazione.php?errore=Compila tutti i campi");
        exit();
    }

    require "database.php";


    $connessione = new mysqli($host, $username, $password, $database);

    if ($connessione->connect_errno){
        die("Connessione fallita: " . $connessione->connect_error);
    }

    $query = "SELECT * FROM UrbanFix_Users";
    $risultato = $connessione->query($query);

    echo var_dump($risultato);

    

    /*$utenti = [];
    while ($row = mysqli_fetch_assoc($risultato)) {
        $utente = new stdClass();
        $utente->username = $row["username"];
        $utente->password = $row["password"];
        $utenti[] = $utente;
    }

    foreach ($utenti as $utente) {
        if ($utente->username === trim($_POST["username"])) {
            error_log("Username già esistente");
            header("Location: registrazione.php?errore=Username gia esistente");
            die();
        }
    }

    $newUser = new stdClass();
    $newUser->username = trim($_POST["username"]);
    $salt = bin2hex(random_bytes(16));
    var_dump($salt);
    $pepper = trim(file_get_contents("./pepper.txt"));
    $newUser->password = $salt . hash("sha256", ((trim($_POST["password"])) . $salt . $pepper));
    $newUser->role = "user";
    $newUser->userid = random_int(0, 10000);
    //controlla che non esista gia un userid cosi
    foreach ($utenti as $utente) {
        while ($utente->userid === $newUser->userid) {
            $newUser->userid = random_int(0, 10000);
        }
    }

    require "usersdata.php";

    $u = new UserData($newUser->userid);
    $u->salva();

    //$newUser->salt = $salt;

    // $utenti[] = $newUser;
    // file_put_contents("./utenti.json", json_encode($utenti));

    //salva nel database
    $query = "INSERT INTO utenti (userid, username, password, role) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connessione, $query);
    mysqli_stmt_bind_param($stmt, "isss", $newUser->userid, $newUser->username, $newUser->password, $newUser->role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

    header("Location: accedi.php?successo=Registrazione avvenuta con successo, effettua il login");
    exit();*/
?>