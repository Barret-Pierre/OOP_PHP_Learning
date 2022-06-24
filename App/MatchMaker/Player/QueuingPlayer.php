<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

// ************************************ QueuingPlayer ************************************

final class QueuingPlayer extends Player
{

    public function __construct(public Player $player, protected int $range = 1)
    {
        parent::__construct($player->name, $player->ratio);
    }

    public function getRange()
    {
        return $this->range;
    }

    public function upgradeRange(): void
    {
        $this->range = min($this->range + 1, 40);
    }
}
