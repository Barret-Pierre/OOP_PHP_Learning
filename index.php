<?php

declare(strict_types=1);

// ************************************ Test ************************************

$dateOne = new DateTimeImmutable();
echo nl2br(
  $dateOne->format('d/m/Y') . "\n"
);

function foo(DateTimeImmutable $date)
{
  $date->modify('+1 day');
}

$dateTwo = $dateOne;
foo($dateTwo);
echo nl2br(
  $dateOne->format('d/m/Y') . "\n" . $dateTwo->format('d/m/Y') . "\n" .  $dateTwo->modify('+1 day')->format('d/m/Y') . "\n"
);

$test = '
{
"id":2,
"couleur":"rouge",
"forme":"carré"
}';

echo nl2br(
  var_dump(json_decode($test)) . "\n"
);

// ************************************ Pont ************************************

class Pont
{
  public float $longueur = 0;
  public float $largeur = 0;

  public function getSurface(): float {
    return $this->largeur * $this->longueur;
  }
}

$pontRoyal = new Pont;
$pontEurope = new Pont;

$pontRoyal->longueur = 263.0;
$pontRoyal->largeur = 15.0;

$pontEurope->longueur = 286.0;
$pontEurope->largeur = 17.8;

$surfacePontRoyal = $pontRoyal->getSurface();
$surfacePontEurope = $pontEurope->getSurface();


echo nl2br(
  $surfacePontRoyal . "\n" . $surfacePontEurope
);

