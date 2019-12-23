<?php
namespace Hangman\Content;

class ContentMaster{

    private $hangman;

    public function __construct()
    {
        include_once "Hangman.php";
        $this->hangman = $hangmann;
    }

    public function printContent($game_state)
    {
        $this->clearContent();
        $this->print($this->hangman[$game_state["hangman_stage"]]);
        $this->print("");
        $this->print($game_state["guess"]);
        $this->print("");
        $this->print($game_state["errors"]);
        $this->print("");
        $this->printMoveMessage($game_state["result"], $game_state["cipher"]);
    }


    private function clearContent()
    {
		if (strncasecmp(PHP_OS, "win", 3) === 0) {
			popen('cls', 'w');
		} else {
			echo exec('clear');
		}
    }

    private function printMoveMessage($game_result, $cipher)
    {
        switch ($game_result) {
            case '1':
                $this->print("You've won! Congratulations. Enter anything to start a new game");
            break;
            case '-1':
                $this->print("You've lost. Too bad for the poor hanged dude. ".
                            "The correct word was: ".$cipher.". ".
                            "Feel free to start a new game by entering");
            break;
            default:
                $this->print("Enter the letter you think is in the word");
            break;
        }
    }

    private function print($text, $need_newline = true)
    {
        print($text);
        if ($need_newline) {
            print("\r\n");
        }
    }

}
?>