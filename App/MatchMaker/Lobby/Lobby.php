<?php

declare(strict_types=1);

namespace App\MatchMaker\Lobby;

use App\MatchMaker\Player\QueuingPlayer;
use App\MatchMaker\Player\Player;
// ************************************ Lobby ************************************

class Lobby
{
    /** @var array<QueuingPlayer> */
    public array $queuingPlayers = [];  // [greg, jade]

    public function findOponents(QueuingPlayer $player): array // greg
    {
        $minLevel = round($player->getRatio() / 100);  // 400/100 -> 4
        $maxLevel = $minLevel + $player->getRange();   // 4 +1 -> 5

        return array_filter($this->queuingPlayers, static function (QueuingPlayer $potentialOponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOponent->getRatio() / 100); // ratio de jade soit 5 (4.76)

            return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel); // l'élément qui convient à toutes ces conditions
        });
    }

    public function addPlayer(Player $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function addPlayers(Player ...$players): void // prend un tableau débalé 
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }
}
