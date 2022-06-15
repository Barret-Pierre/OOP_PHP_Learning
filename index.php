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
  private const SURFACE_TEXT = 'This bridge measure %d';
  private string $unite = "m²";

  private float $longueur = 0;
  private float $largeur = 0;

  // *************** setters ***************

  public function setLongueur(float $longueur): void
  {
    if($longueur < 0) {
      trigger_error('Longueur is to short min(0)', E_USER_ERROR);
    } else {
      $this->longueur = $longueur;
    }
  }

  public function setLargeur(float $largeur): void
  {
    if($largeur < 0) {
      trigger_error('Largeur is to short min(0)', E_USER_ERROR);
    } else {
      $this->largeur = $largeur;
    }
  }

  // *************** getters ***************

  public function getLongueur(): float
  {
    return $this->longueur;
  }

  public function getLargeur(): float
  {
    return $this->largeur;
  }

  private function getSurface(): float
  {
    return $this->largeur * $this->longueur;
  }

  // *************** getters ***************

  public function printSurface(): void
  {
    echo sprintf(nl2br(self::SURFACE_TEXT . $this->unite . "\n"), $this->getSurface());
  }

}

$pontRoyal = new Pont;
$pontEurope = new Pont;

$pontRoyal->setLongueur(263.0);
$pontRoyal->setLargeur(15.0);

$pontEurope->setLongueur(286.0);
$pontEurope->setLargeur(17.8);

$surfacePontRoyal = $pontRoyal->printSurface();
$surfacePontEurope = $pontEurope->printSurface();


