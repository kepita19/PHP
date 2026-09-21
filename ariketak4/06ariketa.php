<?php
$zenbakiak = array();

for ($i = 0; $i < 10; $i++) {
    $zenbakiak[] = rand(0, 99);
}

$batezbestekoa = array_sum($zenbakiak) / count($zenbakiak);
?>

<p>Zenbakiak: <?php echo implode(', ', $zenbakiak); ?></p>
<p>Batezbestekoa: <?php echo $batezbestekoa; ?></p>
