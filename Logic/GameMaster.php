<?php
namespace Hangman\Logic;

class GameMaster {

    private $language;
    private $game;
    private $contentMaster;

    
    public function __construct($lang)
    {
        $this->setLanguage($lang);
        $this->contentMaster = new \Hangman\Content\ContentMaster($this->language);
        $this->init();
    }

    // For now input - 1st char of whatever entered
    public function proceed($input)
    {
        if( !$this->game ){
            $this->init();
            return;
        }
        
        $this->game->processMove($input);
        $gameState = $this->game->getGameState();
        $this->contentMaster->printContent($gameState);
        if ($gameState["result"] != 0) {
            unset($this->game);
        }
    }

    
    private function setLanguage($lang)
    {
        switch ($lang) {
            case "ru":
            case "rus":
            case "russian":
                $this->language = "Russian";
            break;
            default:
                $this->language = "English";
            break;
        }
    }
    
    private function init()
    {
        $this->game = new Game($this->language);
        $this->contentMaster->printContent($this->game->getGameState());
    }

}
?>