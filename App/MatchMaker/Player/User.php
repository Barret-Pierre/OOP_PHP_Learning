<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

    // ************************************ User ************************************

    abstract class User implements PlayerInterface
    {
        public function __construct(protected string $name, protected float $ratio = 400.0)
        {
        }

        abstract public function getName(): string;

        abstract public function getRatio(): float;

        abstract protected function probabilityAgainst(PlayerInterface $player): float;

        abstract public function updateRatioAgainst(PlayerInterface $player, int $result): void;
    }