<?php
$zenbakia1 = isset($_POST["zenbakia1"]) ? $_POST["zenbakia1"] : "";
$zenbakia2 = isset($_POST["zenbakia2"]) ? $_POST["zenbakia2"] : "";
$eragiketa = isset($_POST["eragiketa"]) ? $_POST["eragiketa"] : "";
$errorea = "";
$emaitza = null;

if (isset($_POST["eragiketa"])) {
    if (filter_var($zenbakia1, FILTER_VALIDATE_INT) === false || filter_var($zenbakia2, FILTER_VALIDATE_INT) === false) {
        $errorea = "Bi balioek zenbaki osoak izan behar dute.";
    } elseif ($eragiketa === "zatiketa" && (int) $zenbakia2 === 0) {
        $errorea = "Ezin da zeroz zatitu.";
    } else {
        $zenbakia1 = (int) $zenbakia1;
        $zenbakia2 = (int) $zenbakia2;
        if ($eragiketa === "batuketa") {
            $emaitza = $zenbakia1 + $zenbakia2;
        } elseif ($eragiketa === "kenketa") {
            $emaitza = $zenbakia1 - $zenbakia2;
        } elseif ($eragiketa === "biderketa") {
            $emaitza = $zenbakia1 * $zenbakia2;
        } elseif ($eragiketa === "zatiketa") {
            $emaitza = $zenbakia1 / $zenbakia2;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>03 ariketa - Emaitza</title>
</head>
<body>
    <h1>Kalkulagailuaren emaitza</h1>
    <?php if ($errorea !== ""): ?>
        <p style="color: red;"><?php echo $errorea; ?></p>
    <?php elseif ($emaitza !== null): ?>
        <p>Emaitza: <?php echo $emaitza; ?></p>
    <?php endif; ?>
    <form action="03ariketaKalkulagailua.php" method="post">
        <label for="zenbakia1">Lehen zenbakia:</label>
        <input type="text" id="zenbakia1" name="zenbakia1" value="<?php echo htmlspecialchars((string) $zenbakia1, ENT_QUOTES, "UTF-8"); ?>">
        <br>
        <label for="zenbakia2">Bigarren zenbakia:</label>
        <input type="text" id="zenbakia2" name="zenbakia2" value="<?php echo htmlspecialchars((string) $zenbakia2, ENT_QUOTES, "UTF-8"); ?>">
        <br>
        <button type="submit" name="eragiketa" value="batuketa">Batuketa</button>
        <button type="submit" name="eragiketa" value="kenketa">Kenketa</button>
        <button type="submit" name="eragiketa" value="biderketa">Biderketa</button>
        <button type="submit" name="eragiketa" value="zatiketa">Zatiketa</button>
    </form>
</body>
</html>