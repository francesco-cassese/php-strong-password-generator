<?php
require_once './src/functions.php';

session_start();

// Se arrivano dati dal form, valido tutto, genero la password e la giro a result.php via sessione.
if (isset($_GET['pass-length'])) {
    $length          = getLengthFromSource($_GET, 'pass-length');
    $uppercase       = getBoolFromSource($_GET, 'uppercase');
    $lowercase       = getBoolFromSource($_GET, 'lowercase');
    $numbers         = getBoolFromSource($_GET, 'numbers');
    $symbols         = getBoolFromSource($_GET, 'symbols');
    $allowRepetition = ($_GET['allow-repetition'] ?? 'yes') === 'yes';

    // Il min/max nell'input si aggira facilmente cambiando l'URL a mano, quindi ricontrollo qui.
    if ($length === null || $length < 3 || $length > 30) {
        $_SESSION['error'] = 'La lunghezza deve essere un numero tra 3 e 30.';
        header('Location: ./index.php');
        exit;
    }

    // Senza ripetizioni ogni carattere si può usare una volta sola, quindi il set scelto deve essere abbastanza grande.
    $availableCharacters = strlen(buildCharacterSet($uppercase, $lowercase, $numbers, $symbols));

    if (!$allowRepetition && $length > $availableCharacters) {
        $_SESSION['error'] = "Senza ripetizioni, con il set scelto puoi generare al massimo $availableCharacters caratteri.";
        header('Location: ./index.php');
        exit;
    }

    $_SESSION['password'] = generatePassword($length, $uppercase, $lowercase, $numbers, $symbols, $allowRepetition);

    header('Location: ./result.php');
    exit;
}

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genera una password sicura</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1>Genera una password sicura</h1>
    </header>
    <main>
        <form class="card" action="./index.php" method="get">

            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="field">
                <label for="pass-length">Imposta lunghezza password</label>
                <input type="number" id="pass-length" name="pass-length" placeholder="indica la lunghezza desiderata..." min="3" max="30">
            </div>

            <div class="field-group">
                <span class="field-group__label">Includi</span>

                <label class="checkbox">
                    <input type="checkbox" name="uppercase" id="uppercase">
                    Maiuscole
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="lowercase" id="lowercase">
                    Minuscole
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="numbers" id="numbers">
                    Numeri
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="symbols" id="symbols">
                    Simboli
                </label>
            </div>

            <div class="field-group">
                <span class="field-group__label">Consenti ripetizioni di uno o più caratteri</span>

                <label class="radio">
                    <input type="radio" name="allow-repetition" id="allow-repetition-yes" value="yes" checked>
                    Sì
                </label>

                <label class="radio">
                    <input type="radio" name="allow-repetition" id="allow-repetition-no" value="no">
                    No
                </label>
            </div>

            <button type="submit">
                Genera la tua password
            </button>
        </form>
    </main>
</body>

</html>