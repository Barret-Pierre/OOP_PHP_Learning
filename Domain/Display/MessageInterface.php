<?php
namespace Domain\Display;

use Domain\User\User;

interface MessageInterface
{
    public function getContent(): string;
    public function getAuthor(): User;
}