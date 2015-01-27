<?php define('_FOOEXEC', 1);

include_once(__DIR__ . '/logic.php');

$foo     = new wordJumble();
$jumble  = $foo->getJumble();
$guesses = $foo->getGuesses();
$message = $foo->getMessage();

include_once(__DIR__ . '/template.php');
