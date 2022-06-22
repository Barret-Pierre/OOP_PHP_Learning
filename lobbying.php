<?php 

declare(strict_types=1);

$title = 'Lobbying';


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


// ************************************ Player ************************************

abstract class User
{
    public function __construct(protected string $name, protected float $ratio = 400.0)
    {
    }

    abstract public function getName(): string;

    abstract protected function probabilityAgainst(self $player): float;

    abstract public function updateRatioAgainst(self $player, int $result): void;

    abstract public function getRatio(): float; 
}


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

    protected function probabilityAgainst(User $player): float
    {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public function updateRatioAgainst(User $player, int $result): void
    {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }

    public function getRatio(): float
    {
        return $this->ratio;
    }
}


// ************************************ QueuingPlayer ************************************

final class QueuingPlayer extends Player 
{

    public function __construct(public Player $player, protected int $range = 1)
    {  
        parent::__construct($player->name , $player->ratio);
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


// ************************************ Read ************************************


ob_start();

$greg = new Player('greg', 400);
$jade = new Player('jade', 376);
$mike = new Player('mike', 340);

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade, $mike);

print_r($lobby->queuingPlayers);

print_r($lobby->findOponents($lobby->queuingPlayers[2]));

$content = ob_get_clean();


// ************************************ Template ************************************

require('template.php');

exit(0);
