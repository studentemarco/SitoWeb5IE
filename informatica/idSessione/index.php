<?php
session_start();

// Gestione logout
if (isset($_GET['logout'])) {
    // Cancella sessione
    session_unset();
    session_destroy();

    // Cancella cookie
    setcookie('nome_utente', '', time() - 3600, "/");

    // Redirect alla pagina principale
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

// Se il nome arriva dal form, salva in sessione e cookie
if (isset($_POST['nome']) && !empty(trim($_POST['nome']))) {
    $nome = trim($_POST['nome']);
    $_SESSION['nome'] = $nome;
    setcookie('nome_utente', $nome, time() + (86400 * 30), "/"); // 30 giorni
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Se la sessione non ha nome ma c'è il cookie, sincronizza la sessione
if (!isset($_SESSION['nome']) && isset($_COOKIE['nome_utente'])) {
    $_SESSION['nome'] = $_COOKIE['nome_utente'];
}

$logged = isset($_SESSION['nome']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <title>Sessione + Cookie - Progetto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container mt-4">
    <h1>Progetto 2 - Sessione e Cookie</h1>

    <?php if ($logged): ?>
        <h2>Ciao, <?= htmlspecialchars($_SESSION['nome']) ?>!</h2>
        <a href="?logout=1" class="btn btn-danger">Logout</a>

    <?php else: ?>
        <h2>Non sei loggato</h2>
        <form method="POST" action="" class="mt-3">
            <div class="mb-3">
                <label for="nome" class="form-label">Inserisci il tuo nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required />
            </div>
            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>