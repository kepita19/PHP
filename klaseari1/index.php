<?php
require_once __DIR__ . "/IrudiGeometrikoa.php";
require_once __DIR__ . "/Triangelua.php";

$irudia = new IrudiGeometrikoa();
$irudia->setIzena("A");
$irudia->setKolorea("urdina");

$triangelua = new Triangelua();
$triangelua->setIzena("B");
$triangelua->setKolorea("berdea");
$triangelua->setAltuera(5);
$triangelua->setOinarria(3);
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2 - Irudi geometrikoak</title>
</head>
<body>
    <h1>Irudi geometrikoak</h1>

    <h2>Irudi geometrikoa</h2>
    <?php $irudia->idatzi(); ?>

    <h2>Triangelua</h2>
    <?php
    $triangelua->idatzi();
    $triangelua->areaKalkulatu();
    ?>
</body>
</html>