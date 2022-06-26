<?php

declare(strict_types=1);

namespace App\MatchMaker\Lobby;

use App\MatchMaker\Player\PlayerInterface;

interface LobbyInterface
{
    public function isPlaying(PlayerInterface $player): bool;

    public function addPlayer(PlayerInterface $player): void;
}