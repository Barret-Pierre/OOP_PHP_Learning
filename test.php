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



class A { 
    public function __construct(private int $peugeot = 33) { } 
    public function dites33() { echo $this->peugeot; }
}

(new A)->dites33('80'); 