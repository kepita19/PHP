<?php

$testua = "Kaixo mundua";
$ordezkoKarakterea = '*';
$emaitza = str_replace(['a', 'e', 'i', 'o', 'u'], $ordezkoKarakterea, $testua);

echo $emaitza;
?>