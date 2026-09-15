<?php

$alderdiBikoitiak = true;
$azkenZenbakia = rand(1, 98);

if ($alderdiBikoitiak) {
	for ($zenbakia = 2; $zenbakia <= $azkenZenbakia; $zenbakia += 2) {
		echo $zenbakia . " <br>\n";
	}
} else {
	for ($zenbakia = 1; $zenbakia <= $azkenZenbakia; $zenbakia += 2) {
		echo $zenbakia . "<br>\n";
	}
}
?>
