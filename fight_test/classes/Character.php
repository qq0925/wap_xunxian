<?php
class Character {
    public $name;
    public $attack;
    public $hp;
    public $maxHp;
    public $mp;
    public $maxMp;
    public $position;
    public $team;
    public $speed;
    public $attackRange;
    public $skillName;
    public $skillEffect;
    public $skillMpCost;
    
    public function __construct($name, $attack, $hp, $position, $team, $speed, $attackRange = 1, $skillName = "", $skillEffect = "normal", $mp = 100, $skillMpCost = 20) {
        $this->name = $name;
        $this->attack = $attack;
        $this->hp = $hp;
        $this->maxHp = $hp;
        $this->mp = $mp;
        $this->maxMp = $mp;
        $this->position = $position;
        $this->team = $team;
        $this->speed = $speed;
        $this->attackRange = $attackRange;
        $this->skillName = $skillName;
        $this->skillEffect = $skillEffect;
        $this->skillMpCost = $skillMpCost;
    }
}