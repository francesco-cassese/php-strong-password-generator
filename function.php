<?php 
function generatePassword( int $length) : string {

$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
$password = '';
$maxIndex = strlen($characters) - 1;

for($i = 0; $i < $length; $i++){
    $randomIndex = random_int(0, $maxIndex);

    $password .= $characters[$randomIndex];
}

return $password;

}

?>