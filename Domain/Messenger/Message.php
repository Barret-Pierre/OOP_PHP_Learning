<?php

// ************************************ Header ************************************


declare(strict_types=1);


// ************************************ Class Namespaced ************************************

namespace Domain\Messenger;

use Domain\Display\MessageInterface;
use Domain\User\User;
use Domain\Mixins;

class Message implements MessageInterface
{
    use Mixins\ContentAware, Mixins\UserAware;  

    public function __construct(User $author, string $content)
    {
        $this->content = $content;
        $this->author = $author;
    }

    public function printMessage(): string 
    {
        return sprintf("Bonjour %s, votre niveau est de %d", $this->author->getName(), $this->author->getRatio());
    }
}