<?php

declare(strict_types=1);

$title = 'Heritage';

abstract class Users 
{
    protected const STATUS_ACTIVE = 'actif';
    protected const STATUS_INACTIVE = 'inactif';
    protected const STATUS = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    protected static $nombreUsersInit = 0;

    public function __construct(protected string $username, protected string $status = self::STATUS_ACTIVE)
    {
    }

    public function setStatus(string $status): void
    {
        if(!in_array($status, static::STATUS)) {
            trigger_error(sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', static::STATUS)), E_USER_ERROR);
        };

        $this->status = $status;
    }

    public function printStatus(): void
    {
        echo nl2br("L'utilisateur " . $this->username . " est : " . $this->status . "\n");
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    abstract function getUsername(): string;
}

final class Admin extends Users
{
    private const STATUS_LOCKED = 'locked';
    protected const STATUS = [...parent::STATUS, self::STATUS_LOCKED]; 
    
    public function __construct(public string $email, protected string $status = self::STATUS_ACTIVE, private array $roles = [])
    {
        parent::__construct($email, $status);
    }

    protected static $nombreAdminsInit = 0;

    public static function newInitialize(): void
    {
        self::$nombreAdminsInit++;
        parent::$nombreUsersInit++;
    }

    public function printStatus(): void
    {
        echo nl2br("L'administrateur " . $this->username . " est : " . $this->status . "\n");
    }

    public function setStatus(string $status): void
    {
        if(!in_array($status, self::STATUS)) {
            trigger_error(sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', self::STATUS)), E_USER_ERROR);
        };

        $this->status = $status;
    }

    public function getStatus(): string
    {
        return strtoupper(parent::getStatus());
    }


    public function addRole(string $role): void
    {
        $this->roles[] = $role;
        $this->roles = array_unique($this->roles);
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ADMIN';
        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

class Player extends Users
{
    public function __construct(public string $email, public string $name, protected string $status = self::STATUS_ACTIVE)
    {   
        parent::__construct($name, $status);
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        return $this->level = $level;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

ob_start();

// $user1 = new User('user1', 'active');
// echo $user1->getStatus();
// $user1->setStatus('test');

$admin = new Admin('paul.admin@gmail.com');
$player = new Player('jade.player@gmail.com', 'Jade');

echo nl2br($admin->getUsername() . "\n");
echo nl2br($player->getUsername() . "\n");

$admin->printStatus();
$admin->setStatus('inactif');
$admin->printStatus();
$admin->setStatus('locked');
$admin->printStatus();
echo nl2br($admin->getStatus() . "\n");

// echo nl2br($admin1->getStatus() . "\n");
// $admin1->setStatus('inactive');
echo nl2br(var_dump($admin->getRoles()) . "\n");
$admin->addRole('USER');
echo nl2br(var_dump($admin->getRoles()) . "\n");
$admin->setRoles(['ADMIN']);
echo nl2br(var_dump($admin->getRoles()) . "\n");



$content = ob_get_clean();

require('template.php');
