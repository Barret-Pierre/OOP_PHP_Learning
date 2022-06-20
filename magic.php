<?php

declare(strict_types=1);

class Tablier
{
    public function __construct(public float $longueur, public float $largeur)
    {
    }
}

class Pont
{

    private const UNITE = "m";
    public $size = null;

    public function __construct(protected $name, protected Tablier $tablier)
    {
        $this->size = fn () => $this->tablier->longueur * $this->tablier->largeur;
    }

    public function __clone()
    {
        $this->tablier = clone $this->tablier;
    }

    public function __toString()
    {
        return sprintf('Le %s mesure %d%s de long pour %d%s de large', $this->name, $this->tablier->longueur, self::UNITE, $this->tablier->largeur, self::UNITE);
    }

    public function __sleep()
    {
        return ['name', 'tablier', 'size'];
    }

    public function __wakeup()
    {
        $this->size = fn () => $this->tablier->longueur * $this->tablier->largeur;
    }

    public function __serialize(): array
    {
        return [
            'name' => $this->name,
            'longueur' => $this->tablier->longueur,
            'largeur' => $this->tablier->largeur,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name = $data['name'];
        $this->tablier = new Tablier($data['longueur'], $data['largeur']);
    }
}

class Majuscule
{
    public function __invoke(string $chaine)
    {
        return strtoupper($chaine);
    }
}

class ItsPrivate
{
    private string $private = "Hé c'est privé!";

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value): void
    {
        $this->$name = $value;
    }

    public function __isset($name): bool
    {
        return isset($this->$name);
    }

    public function __unset($name)
    {
        unset($this->$name);
    }
}

$maj = new Majuscule;

$pontRoyal = new Pont($maj("Pont Royal"), new Tablier(263.0, 15.0));
$pontEurope = new Pont($maj("Pont de l'Europe"), new Tablier(280.0, 17.8));

// $pontEurope2 = clone $pontEurope;
// $pontEurope2->tablier->longueur = 12.4;
echo nl2br(
    $pontRoyal . "\n" . $pontEurope . "\n"
);

$chainePontEurope = serialize($pontEurope);
echo nl2br(
    $chainePontEurope . "\n"
);

$pontEurope2 = unserialize($chainePontEurope, ['allowed_classes' => [Pont::class, Tablier::class]]);
var_dump($pontEurope2);

$priv = new ItsPrivate;
echo nl2br(
    "\n" . $priv->private . "\n"
);

$priv->private = "Pas tant que ça en fait!";
echo nl2br(
    "\n" . $priv->private . "\n"
);

echo nl2br(
    "\n" . isset($priv->private) . "\n"
);

unset($priv->private);

