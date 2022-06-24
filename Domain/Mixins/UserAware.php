<?php
 declare(strict_types=1);

 namespace Domain\Mixins;

 use Domain\User\User;
 
 trait UserAware {
    protected User $author;

    public function getAuthor(): User {
        return $this->author;
    }

    public function setAuthor(User $author): void {
        $this->author = $author;
    }
 }