<?php
require_once './function.php';

$length = getLengthFromSource($_GET, 'pass-length');

session_start();

// Salvo la lunghezza in sessione perché voglio che result.php la recuperi
// senza doverla ripassare in query string.
$_SESSION['pass-length'] = $length;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generatore di Password</title>
</head>
<body>
    <header>
        <h1>Generatore di Password</h1>
    </header>
    <main>
    <form action="./result.php" method="get">

    <label for="pass-length">Imposta lunghezza password</label>
    <input type="number" id="pass-length" name="pass-length" placeholder="indica la lunghezza desiderata..." min="3" max="30">

    <button type="submit">
        Genera la tua password
    </button>
    </form>
    </main>
</body>
</html>