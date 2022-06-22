<?php

declare(strict_types=1);

$title = 'Test';

ob_start();

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

$content = ob_get_clean();

require('template.php');