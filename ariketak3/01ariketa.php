<?php

$lerroKopurua = $_GET['lerroKopurua'] ?? 0;
$lerroKopurua = (int) $lerroKopurua;

echo '<form method="GET">';
echo '<label for="lerroKopurua">Lerro kopurua:</label>';
echo '<input type="number" id="lerroKopurua" name="lerroKopurua" min="1" required>';
echo '<button type="submit">Inprimatu</button>';
echo '</form>';

for ($lerroa = 1; $lerroa <= $lerroKopurua; $lerroa++) {
	for ($i = 1; $i <= $lerroa; $i++) {
		echo 'o';
	}
	echo "<br>\n";
}
?>
