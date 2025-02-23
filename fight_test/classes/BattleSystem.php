<?php
class BattleSystem {
    private $characters = [];
    private $turnOrder = [];
    
    public function addCharacter(Character $character) {
        $this->characters[] = $character;
    }
    
    public function determineTurnOrder() {
        $this->turnOrder = $this->characters;
        usort($this->turnOrder, function($a, $b) {
            return $b->speed - $a->speed;
        });
        return $this->turnOrder;
    }

    public function getCharacters() {
        return $this->characters;
    }
}