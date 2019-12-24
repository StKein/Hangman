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
        $words = explode("\r\n", file_get_contents(__DIR__."/../Content/".$language."/Words.txt"));
        $this->cipher = $words[random_int( 0, count($words) - 1)];
        $this->guess = array_fill(0, mb_strlen($this->cipher), "-");
        $this->errors = "-";
        $this->hangman_stage = 8;
        $this->result = 0;
    }

    public function processMove($char)
    {
        if (!$char || in_array($char, $this->guess) || mb_strpos($this->errors, $char) !== false) {
            return;
        }

        $pos = mb_strpos($this->cipher, $char);
        if ($pos !== false) {
            while ($pos !== false) {
                $this->guess[$pos] = $char;
                $pos = mb_strpos($this->cipher, $char, $pos+1);
            }
            if (implode("", $this->guess) == $this->cipher) {
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
            'guess' => implode("", $this->guess),
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