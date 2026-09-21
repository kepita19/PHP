<?php
$hiztegia = array(
    "etxea" => "house",
    "txakurra" => "dog",
    "autoa" => "car",
    "liburua" => "book",
    "aulkia" => "chair"
);

$gakoenArabera = $hiztegia;
ksort($gakoenArabera);

$balioenArabera = $hiztegia;
natsort($balioenArabera);
?>

<h2>Jatorrizko arraya</h2>
<pre><?php print_r($hiztegia); ?></pre>

<h2>Gakoaren arabera ordenatuta (ksort)</h2>
<pre><?php print_r($gakoenArabera); ?></pre>

<h2>Balioaren arabera ordenatuta (natsort)</h2>
<pre><?php print_r($balioenArabera); ?></pre>
