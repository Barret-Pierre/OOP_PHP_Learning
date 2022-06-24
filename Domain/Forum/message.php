<?php

// ************************************ Header ************************************


declare(strict_types=1);


// ************************************ Class Namespaced ************************************

namespace Domain\Forum;

use Domain\User\User;

class Message
{
    private $content;
    private $author;

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