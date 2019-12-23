<?php
namespace Hangman\Logic;

class GameMaster {

    private $game;
    private $contentMaster;

    
    public function __construct()
    {
        $this->contentMaster = new \Hangman\Content\ContentMaster();
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

    
    private function init()
    {
        $this->game = new Game();
        $this->contentMaster->printContent($this->game->getGameState());
    }

}
?>