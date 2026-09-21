<?php
$zenbakiak = array();

for ($i = 0; $i < 10; $i++) {
    $zenbakiak[] = rand(1, 200);
}
?>

<h2>Arraya print_r erabiliz</h2>
<pre><?php print_r($zenbakiak); ?></pre>

<h2>Arraya foreach erabiliz</h2>
<ul>
<?php foreach ($zenbakiak as $gakoa => $balioa): ?>
    <li><?php echo $gakoa . ' => ' . $balioa; ?></li>
<?php endforeach; ?>
</ul>

<h2>Arraya alderantziz</h2>
<pre><?php print_r(array_reverse($zenbakiak)); ?></pre>
