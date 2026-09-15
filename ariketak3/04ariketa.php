<?php

$zenbakia = (int) ($_GET['zenbakia'] ?? 0);
$esPrimo = $zenbakia >= 2;

for ($zatikia = 2; $zatikia < $zenbakia; $zatikia++) {
	if ($zenbakia % $zatikia == 0) {
		$esPrimo = false;
	}
}

echo '<form method="GET">';
echo '<label for="zenbakia">Zenbakia:</label>';
echo '<input type="number" id="zenbakia" name="zenbakia" min="1" required>';
echo '<button type="submit">Egiaztatu</button>';
echo '</form>';

if ($esPrimo) {
	echo "Zenbakia lehena da";
} else {
	echo "Zenbakia ez da lehena";
}
?>
