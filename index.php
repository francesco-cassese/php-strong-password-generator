<?php 
include './function.php';
$length = isset($_GET['pass-length']) ? (int) $_GET['pass-length'] : null; 
$password = generatePassword($length);
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
    <form action="" method="get">

    <label for="pass-length">Imposta lunghezza password</label>
    <input type="number" id="pass-length" name="pass-length" placeholder="indica la lunghezza desiderata..." min="3" max="30">

    <button type="submit">Genera la tua password</button>
    </form>

    <div>
        <p><?php echo "La password generata è '{$password}'" ?></p>
    </div>

    </main>
</body>
</html>