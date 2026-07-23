<?php
// Leggo un intero da $_GET o $_SESSION, con null se la chiave non esiste.
function getLengthFromSource(array $source, string $key): ?int {
    return isset($source[$key]) ? (int) $source[$key] : null;
}

// Controllo solo se la chiave è presente in $_GET o $_SESSION (checkbox spuntata o no).
function getBoolFromSource(array $source, string $key): bool{
    return isset($source[$key]);
}

function buildCharacterSet(bool $includeUppercase, bool $includeLowercase, bool $includeNumbers, bool $includeSymbols): string {
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers   = '0123456789';
    $symbols   = '!@#$%^&*()';

    $characters = '';

    if ($includeUppercase) $characters .= $uppercase;
    if ($includeLowercase) $characters .= $lowercase;
    if ($includeNumbers)   $characters .= $numbers;
    if ($includeSymbols)   $characters .= $symbols;

    // Se nessun set è stato selezionato, uso tutti i caratteri disponibili.
    if ($characters === '') {
        $characters = $uppercase . $lowercase . $numbers . $symbols;
    }

    return $characters;
}

// Estraggo $length caratteri a caso da $characters, uno alla volta: possono ripetersi.
function generateWithRepetition(string $characters, int $length): string {
    $maxIndex = strlen($characters) - 1;
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, $maxIndex);
        $password .= $characters[$randomIndex];
    }

    return $password;
}

// Mescolo tutti i caratteri di $characters (Fisher-Yates con random_int) e ne prendo i primi $length.
function generateWithoutRepetition(string $characters, int $length): string {
    $pool = str_split($characters);

    for ($i = count($pool) - 1; $i > 0; $i--) {
        $j = random_int(0, $i);
        [$pool[$i], $pool[$j]] = [$pool[$j], $pool[$i]];
    }

    // Se $length è maggiore del pool disponibile, restituisco tutto il pool.
    return implode('', array_slice($pool, 0, $length));
}

// Costruisco il set di caratteri, poi genero la password con o senza ripetizioni.
function generatePassword(int $length, bool $includeUppercase, bool $includeLowercase, bool $includeNumbers, bool $includeSymbols, bool $allowRepetition): string {
    $characters = buildCharacterSet($includeUppercase, $includeLowercase, $includeNumbers, $includeSymbols);

    if ($allowRepetition) {
        return generateWithRepetition($characters, $length);
    }

    return generateWithoutRepetition($characters, $length);
}

?>