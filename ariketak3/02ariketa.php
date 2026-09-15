<?php

$lehenZenb = $_GET['lehenZenb'] ?? 0;
$azkenZenb = $_GET['azkenZenb'] ?? 0;
$batura = 0;

echo '<form method="GET">';
echo '<label for="lehenZenb">Lehen zenbakia:</label>';
echo '<input type="number" id="lehenZenb" name="lehenZenb" required> <br>';
echo '<label for="azkenZenb">Azken zenbakia:</label>';
echo '<input type="number" id="azkenZenb" name="azkenZenb" required> <br>';
echo '<button type="submit">Kalkulatu</button>';
echo '</form>';

for ($zenbakia = $lehenZenb; $zenbakia <= $azkenZenb; $zenbakia++) {
	$batura += $zenbakia;
}

echo "Batuketa: " . $batura;
?>
