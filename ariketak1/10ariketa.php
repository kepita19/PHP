<?php

date_default_timezone_set('Europe/Madrid');

$irteeraData = new DateTime('2026-09-20 14:30:00');
$oraingoData = new DateTime();

if ($irteeraData > $oraingoData) {
	$faltaDenDenbora = $oraingoData->diff($irteeraData);

	echo "Hegazkina hartzeko falta den denbora: ";
	echo $faltaDenDenbora->format('%a egun, %h ordu eta %i minutu');
} else {
	echo "Hegazkinaren irteera-data igaro da.";
}
?>
