<?php

// ************************************ Header ************************************


declare(strict_types=1);

spl_autoload_register();

use Domain\Forum\Message;
use Domain\Messenger\Messages;
Use Domain\User\User;

$user = new User('Greg', 450);

$forumMessage = new Message;
$forumMessage->setContent('hello');
$forumMessage->setAuthor(new User('Jade', 760));
$messengerMessage = new Messages($user, 'Coucou tous le monde!');
$date = new DateTime();

// ************************************ Read ************************************

ob_start();

var_dump($forumMessage::class);
var_dump($messengerMessage::class);
echo nl2br("\n" . $date->format('d/m/Y') . "\n");

echo nl2br($messengerMessage->printMessage() . "\n");
echo sprintf('Ceci est un message de %s: " %s "', $forumMessage->getAuthor()->getName(), $forumMessage->getContent());

$content = ob_get_clean();

// ************************************ Template ************************************

$title = 'Message';
require('template.php');




