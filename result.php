<?php
require_once './function.php';

session_start();

// Leggo le scelte dell'utente salvate in sessione da index.php.
$length     = getLengthFromSource($_SESSION, 'pass-length');
$uppercase  = getBoolFromSource($_SESSION, 'uppercase');
$lowercase  = getBoolFromSource($_SESSION, 'lowercase');
$numbers    = getBoolFromSource($_SESSION, 'numbers');
$symbols    = getBoolFromSource($_SESSION, 'symbols');
$allowRepetition = $_SESSION['allow-repetition'] ?? true;

// Se manca la lunghezza in sessione, torno al form: niente da generare.
if($length === null){
    header('Location: ./index.php');
    exit;
}

$password = generatePassword($length, $uppercase, $lowercase, $numbers, $symbols, $allowRepetition);

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato</title>
</head>
<body>
    <header>
    <h1>Ecco qui la tua password</h1>
    </header>
    <main>
        <div>
            <p> <?php echo $password ?></p>
        </div>
    </main>
    
</body>
</html>