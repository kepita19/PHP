<?php

$bikoitiak = strtoupper($_GET['bikoitiak'] ?? 'FALSE') == 'TRUE';
$azkenZenbakia = rand(1, 98);

echo '<form method="GET">';
echo '<label for="bikoitiak">Bikoitiak:</label>';
echo '<select id="bikoitiak" name="bikoitiak">';
echo '<option value="TRUE">TRUE</option>';
echo '<option value="FALSE">FALSE</option>';
echo '</select>';
echo '<button type="submit">Erakutsi</button>';
echo '</form>';

if ($bikoitiak) {
	$hasierakoZenbakia = 2;
} else {
	$hasierakoZenbakia = 1;
}

for ($zenbakia = $hasierakoZenbakia; $zenbakia <= $azkenZenbakia; $zenbakia += 2) {
	echo $zenbakia . "<br>\n";
}
?>
