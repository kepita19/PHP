<?php

$zenb1 = 3;
$zenb2 = 2;


$batura = $zenb1 + $zenb2;
$biderketa = $zenb1 * $zenb2;

if ($batura > $biderketa) {
    echo "Batura biderketa baino handiagoa da";
} elseif ($biderketa > $batura) {
    echo "Biderketa gehiketa baino handiagoa da";
} else {
    echo "Batura eta biderketa berdinak dira";
}
?>
