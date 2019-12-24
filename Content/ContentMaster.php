<?php
namespace Hangman\Content;

class ContentMaster{

    private $hangman;
    private $messages;

    public function __construct($language)
    {
        include_once "Hangman.php";
        $this->hangman = $hangmann;
        $this->messages = simplexml_load_file(__DIR__."/".$language."/Messages.xml");
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
                $this->print($this->messages->win);
                $this->print($this->messages->continue);
            break;
            case '-1':
                $this->print($this->messages->loss);
                $this->print($this->messages->loss_cipher.$cipher);
                $this->print($this->messages->continue);
            break;
            default:
                $this->print($this->messages->move);
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