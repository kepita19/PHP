<?php
$zenbakiak = array(12, 45, 8, 67, 23, 90, 1000, 39, 52, 19);
$handiena = $zenbakiak[0];

for ($i = 1; $i < count($zenbakiak); $i++) {
    if ($zenbakiak[$i] > $handiena) {
        $handiena = $zenbakiak[$i];
    }
}
?>

<p>Handiena: <?php echo $handiena; ?></p>
