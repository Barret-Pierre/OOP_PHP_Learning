<?php

// ************************************ Header ************************************


declare(strict_types=1);

spl_autoload_register();

use Domain\Forum\Message as ForumMessage;
use Domain\Messenger\Message as MessengerMessage;
Use Domain\User\User;
use Domain\Display\MessageInterface;

// ************************************ MessagePrinter ************************************

class MessagePrinter
{
    public static function printMessage(MessageInterface $message)
    {
        echo sprintf(nl2br("%s %s\n"), $message->getContent(), $message->getAuthor()->getName());
    }
}


$user = new User('Greg', 450);

$forumMessage = new ForumMessage;
$forumMessage->setContent('Hello');
$forumMessage->setAuthor(new User('Jade', 760));
$messengerMessage = new MessengerMessage($user, 'Coucou tous le monde!');
$date = new DateTime();

// ************************************ Read ************************************

ob_start();

var_dump($forumMessage::class);
var_dump($messengerMessage::class);
echo nl2br("\n" . $date->format('d/m/Y') . "\n");

(new MessagePrinter)->printMessage($forumMessage);
(new MessagePrinter)->printMessage($messengerMessage);

$content = ob_get_clean();

// ************************************ Template ************************************

$title = 'Message';
require('template.php');




