<?php

$lehenZenb = 2;
$azkenZenb = 5;
$batura = 0;

for ($zenbakia = $lehenZenb; $zenbakia <= $azkenZenb; $zenbakia++) {
	$batura += $zenbakia;
	echo $zenbakia . " : " . $batura . "<br>\n";
}
?>
