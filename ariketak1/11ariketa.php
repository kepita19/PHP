<?php

$testua = "Kaixo mundua";
$bokalenKopurua = 0;

foreach (str_split($testua) as $karakterea) {
	if (in_array($karakterea, ['a', 'e', 'i', 'o', 'u'])) {
		$bokalenKopurua++;
	}
}

echo $bokalenKopurua;
?>
