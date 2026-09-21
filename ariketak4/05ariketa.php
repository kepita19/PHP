<?php
$zenbakiak = array();

for ($i = 0; $i < 10; $i++) {
    $zenbakiak[] = rand(0, 99);
}

$txikiena = min($zenbakiak);
?>

<p>Zenbakiak: <?php echo implode(', ', $zenbakiak); ?></p>
<p>Txikiena: <?php echo $txikiena; ?></p>
