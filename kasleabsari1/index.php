<?php
require_once __DIR__ . "/Txartela.php";
require_once __DIR__ . "/Eskudirua.php";
require_once __DIR__ . "/Txakurra.php";
require_once __DIR__ . "/Bizikleta.php";

function eginOrdainketa(Ordaingarria $ordainketaModua, float $zenbatekoa): void
{
    $ordainketaModua->ordaindu($zenbatekoa);
}

$txartela = new Txartela();
$eskudirua = new Eskudirua();
$txakurra = new Txakurra();
$bizikleta = new Bizikleta();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfazeak eta klase abstraktuak</title>
</head>
<body>
    <h1>Interfazeak eta klase abstraktuak</h1>

    <h2>Ordainketa interfazea</h2>
    <p><?php eginOrdainketa($txartela, 25.50); ?></p>
    <p><?php eginOrdainketa($eskudirua, 25.50); ?></p>

    <h2>Animalia klase abstraktua</h2>
    <p>Txakurraren soinua: <?php echo htmlspecialchars($txakurra->soinua(), ENT_QUOTES, "UTF-8"); ?></p>
    <p>Txakurra lo: <?php echo htmlspecialchars($txakurra->lo_egin(), ENT_QUOTES, "UTF-8"); ?></p>

    <h2>Bizikleta: interfazea eta klase abstraktua</h2>
    <p>Mugitzeko modua: <?php echo htmlspecialchars($bizikleta->mugitu(), ENT_QUOTES, "UTF-8"); ?></p>
    <p>Gelditzean: <?php echo htmlspecialchars($bizikleta->gelditu(), ENT_QUOTES, "UTF-8"); ?></p>
</body>
</html>