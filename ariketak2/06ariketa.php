<?php

$lehenZenb = 2;
$azkenZenb = 5;
$adierazpena = (string) $lehenZenb;

for ($zenbakia = 1; $zenbakia <= $azkenZenb; $zenbakia++) {
	$adierazpena .= "+ " . $zenbakia;
}

echo "Emaitza = " . $adierazpena;
?>
