<?php
// Ho centralizzato qui la lettura della lunghezza perché mi serve sia da $_GET (index.php)
// sia da $_SESSION (result.php), ed evito così di duplicare il controllo isset() + cast.
function getLengthFromSource(array $source, string $key): ?int {
    return isset($source[$key]) ? (int) $source[$key] : null;
}

function generatePassword( int $length) : string {

$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
$password = '';
$maxIndex = strlen($characters) - 1;

// Uso random_int() invece di rand()/mt_rand() perché mi serve un generatore
// crittograficamente sicuro: sto generando una password, non un valore qualsiasi.
for($i = 0; $i < $length; $i++){
    $randomIndex = random_int(0, $maxIndex);

    $password .= $characters[$randomIndex];
}

return $password;

}

?>