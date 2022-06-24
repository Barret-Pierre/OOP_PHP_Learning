<?php

declare(strict_types=1);

spl_autoload_register();

use App\MatchMaker\Lobby\Lobby;
use App\MatchMaker\Player\Player;
use App\MatchMaker\Player\BlittzPlayer;

// ************************************ Read ************************************


ob_start();

$greg = new Player('greg', 400);
$jade = new Player('jade', 376);
$mike = new Player('mike', 340);
$dave = new BlittzPlayer('dave');
$june = new BlittzPlayer('june');

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade, $mike, $dave, $june);

print_r($lobby->queuingPlayers);

print_r($lobby->findOponents($lobby->queuingPlayers[3]));

$content = ob_get_clean();


// ************************************ Template ************************************

$title = 'Lobbying';
require('template.php');

exit(0);
