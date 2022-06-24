<?php 

declare(strict_types=1);

namespace Domain\User;

    // ************************************ Player ************************************

    class User
    {
        public function __construct(protected string $name, protected float $ratio = 400.0)
        {
        }

        public function getName()
        {
            return $this->name;
        }

        public function getRatio()
        {
            return $this->ratio;
        }
    }
