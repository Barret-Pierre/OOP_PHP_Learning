<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

// ************************************ BlittzPlayer ************************************

final class BlittzPlayer extends Player
{

    public function __construct(public string $name = 'anonymous', public float $ratio = 1200.0)
    {
        parent::__construct($name, $ratio);
    }

    public function updateRatioAgainst(PlayerInterface $player, int $result): void
    {
        $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
    }
}
