<?php
require_once './function.php';

session_start();

// Reindirizzo a index.php se questa pagina viene raggiunta senza essere passati
// dal form: senza una lunghezza in sessione non ho nulla da generare.
// Aggiungo exit subito dopo header() perché senza non fermerei l'esecuzione dello script.
if(!isset($_SESSION['pass-length'])){
    header('Location: ./index.php');
    exit;
}

$length = getLengthFromSource($_SESSION, 'pass-length');

$password = generatePassword($length);

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