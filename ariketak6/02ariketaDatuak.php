<?php
function testua($izena) {
    return isset($_POST[$izena]) && trim($_POST[$izena]) !== "";
}

function erakutsi($izena) {
    echo htmlspecialchars($_POST[$izena], ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Datos personales - Resultado</title>
    <style>
        .errorea { color: red; }
        .balioa { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Datos personales</h1>
    <?php if (testua("nombre")): ?>
        <p>Su nombre es <strong><?php erakutsi("nombre"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado su nombre.</p>
    <?php endif; ?>

    <?php if (testua("apellidos")): ?>
        <p>Sus apellidos son <strong><?php erakutsi("apellidos"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado sus apellidos.</p>
    <?php endif; ?>

    <?php if (testua("edad")): ?>
        <p>Su edad es <strong><?php erakutsi("edad"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado su edad.</p>
    <?php endif; ?>

    <?php if (testua("peso")): ?>
        <p>Su peso es <strong><?php erakutsi("peso"); ?></strong> kg.</p>
    <?php else: ?>
        <p class="errorea">No ha escrito su peso.</p>
    <?php endif; ?>

    <?php if (testua("sexo")): ?>
        <p>Es <strong><?php erakutsi("sexo"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado su sexo.</p>
    <?php endif; ?>

    <?php if (testua("estado_civil")): ?>
        <p>Su estado civil es <strong><?php erakutsi("estado_civil"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado su estado civil.</p>
    <?php endif; ?>

    <?php if (isset($_POST["aficiones"]) && is_array($_POST["aficiones"]) && count($_POST["aficiones"]) > 0): ?>
        <p>Le gusta: <strong><?php echo htmlspecialchars(implode(", ", $_POST["aficiones"]), ENT_QUOTES, "UTF-8"); ?></strong>.</p>
    <?php else: ?>
        <p class="errorea">No ha indicado sus aficiones.</p>
    <?php endif; ?>

    <a href="02ariketaDatuak.html">Volver al formulario</a>
</body>
</html>