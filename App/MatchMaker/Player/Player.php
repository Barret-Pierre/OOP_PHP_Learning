<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

// ************************************ Player ************************************

class Player extends User
{
    public function __construct(protected string $name, protected float $ratio = 400.0)
    {
        parent::__construct($name, $ratio);
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function probabilityAgainst(PlayerInterface $player): float
    {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public function updateRatioAgainst(PlayerInterface $player, int $result): void
    {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }

    public function getRatio(): float
    {
        return $this->ratio;
    }
}
