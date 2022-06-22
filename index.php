<?php

declare(strict_types=1);

$title = 'OOP';

// ************************************ Pont ************************************

class Pont
{
  private const SURFACE_TEXT = 'This bridge measure %d';
  private const UNITE = "m²";

  // *************** constructor ***************

  public function __construct(private float $longueur, private float $largeur) 
  {
  }

  // *************** setters ***************

  public function setLongueur(float $longueur): void
  {
    self::validerTaille($longueur);
    $this->longueur = $longueur;
  }


  public function setLargeur(float $largeur): void
  {
    if ($largeur < 0) {
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

  // *************** reader ***************

  public function printSurface(): void
  {
    echo sprintf(nl2br(self::SURFACE_TEXT . self::UNITE . "\n"), $this->getSurface());
  }

  // *************** statics methods ***************

  public static function validerTaille(float $taille): bool
  {
    if ($taille < 50.0) {
      trigger_error('La dimaension est trop courte (50 min).', E_USER_ERROR);
    }

    return true;
  }
  // *************** statics props ***************

  public static int $numberOfWalker = 0;

  public function addWalker()
  {
    self::$numberOfWalker++;
  }
}

ob_start();

$pontRoyal = new Pont(263.0, 15.0);
$pontEurope = new Pont(280.0, 17.8);

// $pontRoyal->setLongueur(263.0);
// $pontRoyal->setLargeur(15.0);

// $pontEurope->setLongueur(280.0);
// $pontEurope->setLargeur(17.8);

$surfacePontRoyal = $pontRoyal->printSurface();
$surfacePontEurope = $pontEurope->printSurface();

$pontEurope->addWalker();
$pontEurope->addWalker();
$pontRoyal->addWalker();

var_dump(Pont::$numberOfWalker);

$content = ob_get_clean();

require('template.php');
