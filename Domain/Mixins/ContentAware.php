<?php
 declare(strict_types=1);

 namespace Domain\Mixins;

 trait ContentAware {
    protected string $content;

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }
 }

