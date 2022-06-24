<?php

// ************************************ Header ************************************


declare(strict_types=1);

spl_autoload_register();

$user = new \Domain\User\User('Greg', 450);

$forumMessage = new \Domain\Forum\Message($user, 'Coucou tous le monde!');
$messengerMessage = new \Domain\Messenger\Message;
$date = new DateTime();

// ************************************ Read ************************************

ob_start();

var_dump($forumMessage);
var_dump($messengerMessage::class);
echo nl2br("\n" . $date->format('d/m/Y') . "\n");

echo $forumMessage->printMessage();

$content = ob_get_clean();

// ************************************ Template ************************************

$title = 'Message';
require('template.php');




