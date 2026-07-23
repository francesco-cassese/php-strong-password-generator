<?php
session_start();

// Leggo la password già generata da index.php e la rimuovo dalla sessione (dato "usa e getta").
$password = $_SESSION['password'] ?? null;
unset($_SESSION['password']);

// Se manca la password in sessione, torno al form: niente da mostrare.
if ($password === null) {
    header('Location: ./index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header>
        <h1>Ecco qui la tua password</h1>
    </header>
    <main>
        <div class="card result">
            <p class="result__password"><?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?></p>
            <a class="button-link" href="./index.php">Genera un'altra password</a>
        </div>
    </main>
</body>
</html>