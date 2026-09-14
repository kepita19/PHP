<?php

$zenbaki1 = 10;
$zenbaki2 = 20;
$zenbaki3 = 4;


$txikia = 0;
$ertaina = 0;
$handia = 0;


if ($zenbaki1 <= $zenbaki2 && $zenbaki1 <= $zenbaki3) {
    $txikia = $zenbaki1;
    if ($zenbaki2 <= $zenbaki3) {
        $ertaina = $zenbaki2;
        $handia = $zenbaki3;
    } else {
        $ertaina = $zenbaki3;
        $handia = $zenbaki2;
    }
} elseif ($zenbaki2 <= $zenbaki1 && $zenbaki2 <= $zenbaki3) {
    $txikia = $zenbaki2;
    if ($zenbaki1 <= $zenbaki3) {
        $ertaina = $zenbaki1;
        $handia = $zenbaki3;
    } else {
        $ertaina = $zenbaki3;
        $handia = $zenbaki1;
    }
} else {
    $txikia = $zenbaki3;
    if ($zenbaki1 <= $zenbaki2) {
        $ertaina = $zenbaki1;
        $handia = $zenbaki2;
    } else {
        $ertaina = $zenbaki2;
        $handia = $zenbaki1;
    }
}


echo "Orden gorakorra: " . $txikia . ", " . $ertaina . ", " . $handia . "<br>";
echo "Orden beherakorra: " . $handia . ", " . $ertaina . ", " . $txikia;
?>
