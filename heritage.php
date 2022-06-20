<?php

declare(strict_types=1);
 
class User 
{
    protected const STATUS_ACTIVE = 'active';
    protected const STATUS_INACTIVE = 'inactive';
    protected const STATUS = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    public function __construct(public string $username, private string $status = self::STATUS_ACTIVE)
    {
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
        return $this->status;
    }
}

class Admin extends User
{

    public function __construct(public string $username, private string $status = self::STATUS_ACTIVE, private array $roles = [])
    {
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
}

// $user1 = new User('user1', 'active');
// echo $user1->getStatus();
// $user1->setStatus('test');

$admin1 = new Admin('admin1', 'active');
echo nl2br($admin1->getStatus() . "\n");
$admin1->setStatus('inactive');
echo nl2br(var_dump($admin1->getRoles()) . "\n");
$admin1->addRole('USER');
echo nl2br(var_dump($admin1->getRoles()) . "\n");
$admin1->setRoles(['ADMIN']);
echo nl2br(var_dump($admin1->getRoles()) . "\n");

