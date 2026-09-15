<?php

$zenbakia = (int) ($_GET['zenbakia'] ?? 0);

echo '<form method="GET">';
echo '<label for="zenbakia">Zenbakia:</label>';
echo '<input type="number" id="zenbakia" name="zenbakia" min="1" required>';
echo '<button type="submit">Erakutsi</button>';
echo '</form>';

for ($zenbakiLehena = 2; $zenbakiLehena <= $zenbakia; $zenbakiLehena++) {
	$esPrimo = true;

	for ($zatikia = 2; $zatikia < $zenbakiLehena; $zatikia++) {
		if ($zenbakiLehena % $zatikia == 0) {
			$esPrimo = false;
		}
	}

	if ($esPrimo) {
		echo $zenbakiLehena . "<br>\n";
	}
}
?>
