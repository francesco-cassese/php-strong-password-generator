<?php
require_once './function.php';

// Leggo le scelte dell'utente dalla query string inviata dal form.
$length     = getLengthFromSource($_GET, 'pass-length');
$uppercase  = getBoolFromSource($_GET, 'uppercase');
$lowercase  = getBoolFromSource($_GET, 'lowercase');
$numbers    = getBoolFromSource($_GET, 'numbers');
$symbols    = getBoolFromSource($_GET, 'symbols');

session_start();

// Salvo tutto in sessione così result.php lo recupera senza ripassarlo in query string.
$_SESSION['pass-length']      = $length;
$_SESSION['uppercase']        = $uppercase;
$_SESSION['lowercase']        = $lowercase;
$_SESSION['numbers']          = $numbers;
$_SESSION['symbols']          = $symbols;
$_SESSION['allow-repetition'] = ($_GET['allow-repetition'] ?? 'yes') === 'yes';

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genera una password sicura</title>
</head>
<body>
    <header>
        <h1>Genera una password sicura</h1>
    </header>
    <main>
    <form action="./result.php" method="get">

    <label for="pass-length">Imposta lunghezza password</label>
    <input type="number" id="pass-length" name="pass-length" placeholder="indica la lunghezza desiderata..." min="3" max="30">

    <label for="uppercase">Maiuscole</label>
    <input type="checkbox" name="uppercase" id="uppercase">

    <label for="lowercase">Minuscole</label>
    <input type="checkbox" name="lowercase" id="lowercase">

    <label for="numbers">Numeri</label>
    <input type="checkbox" name="numbers" id="numbers">

    <label for="symbols">Simboli</label>
    <input type="checkbox" name="symbols" id="symbols">

    <label>Consenti ripetizioni di uno o più caratteri:</label>
    <input type="radio" name="allow-repetition" id="allow-repetition-yes" value="yes" checked>
    <label for="allow-repetition-yes">Sì</label>

   <input type="radio" name="allow-repetition" id="allow-repetition-no" value="no">
   <label for="allow-repetition-no">No</label>

    <button type="submit">
        Genera la tua password
    </button>
    </form>
    </main>
</body>
</html>