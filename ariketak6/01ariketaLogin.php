<?php
$erabiltzailea = isset($_POST["erabiltzailea"]) ? $_POST["erabiltzailea"] : "";
$pasahitza = isset($_POST["pasahitza"]) ? $_POST["pasahitza"] : "";
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>01 ariketa - Emaitza</title>
</head>
<body>
    <h1>Jasotako informazioa</h1>
    <p>Erabiltzailea: <?php echo htmlspecialchars($erabiltzailea, ENT_QUOTES, "UTF-8"); ?></p>
    <p>Pasahitza: <?php echo htmlspecialchars($pasahitza, ENT_QUOTES, "UTF-8"); ?></p>
    <a href="01ariketaLogin.html">Itzuli loginera</a>
</body>
</html>