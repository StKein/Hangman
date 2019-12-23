<?php
namespace Hangman;

spl_autoload_register(function($class){
    // Cut root namespace
    $class = str_replace(__NAMESPACE__."\\", "", $class);
    // Correct directory separator
    $class = str_replace(["\\", "/"], DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$class.".php");
    // Get file real path
    require_once $class;
});

$gm = new Logic\GameMaster();
$input = "";
do {
	$input = readline();
	$gm->proceed($input[0]);
} while (true);
?>