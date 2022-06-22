<?php

// ************************************ Header ************************************


declare(strict_types=1);


// ************************************ Class Namespaced ************************************

namespace Forum;

class Message
{
}



namespace Messenger;
use \DateTime;

class Message
{
}


$forumMessage = new \Forum\Message;
$messengerMessage = new \Messenger\Message;
$date = new DateTime();

// ************************************ Read ************************************

ob_start();

var_dump($forumMessage::class);
var_dump($messengerMessage::class);
echo nl2br("\n" . $date->format('d/m/Y'));

$content = ob_get_clean();

// ************************************ Template ************************************

$title = 'Message';
require('template.php');




