<?php

$minutuak = 5;

if ($minutuak <= 3) {
	$prezioa = 10;
} else {
	$prezioa = 10 + (($minutuak - 3) * 5);
}

echo "Deiaren prezioa: {$prezioa} zentimo";
?>