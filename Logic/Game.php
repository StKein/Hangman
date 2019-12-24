<?php
namespace Hangman\Logic;

class Game {

    private $cipher;
    private $guess;
    private $errors;
    private $hangman_stage;
    private $result;


    public function __construct($language)
    {
        $words = mb_split("\r\n", file_get_contents(__DIR__."/../Content/".$language."/Words.txt"));
        $this->cipher = $words[random_int( 0, count($words) - 1)];
        $this->guess = str_repeat("-", mb_strlen($this->cipher));
        $this->errors = "-";
        $this->hangman_stage = 8;
        $this->result = 0;
    }

    public function processMove($char)
    {
        if (!$char || mb_strpos($this->guess, $char) !== false || mb_strpos($this->errors, $char) !== false) {
            return;
        }

        $pos = mb_strpos($this->cipher, $char);
        if ($pos !== false) {
            while ($pos !== false) {
                $this->guess[$pos] = $char;
                $pos = mb_strpos($this->cipher, $char, $pos+1);
            }
            if ($this->guess == $this->cipher) {
                $this->result = 1;
            }
            return;
        }

        $this->errors .= $char."-";
        $this->hangman_stage--;
        if ($this->hangman_stage == 0) {
            $this->result = -1;
        }
    }

    public function getGameState()
    {
        return [
            'guess' => $this->guess,
            'errors' => $this->errors,
            'hangman_stage' => $this->hangman_stage,
            'result' => $this->result,
            'cipher' => $this->getCipher()
        ];
    }


    private function getCipher()
    {
        return ($this->result == -1) ? $this->cipher : "";
    }

}
?>