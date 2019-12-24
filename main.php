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

$lang = mb_strtolower($argv[1]) ?? "";
$gm = new Logic\GameMaster($lang);
do {
	$gm->proceed(mb_substr(readline(), 0, 1));
} while (true);
?>