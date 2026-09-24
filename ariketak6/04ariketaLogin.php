<?php
$user = "paco";
$password = password_hash("fiestas", PASSWORD_DEFAULT);
$mezua = isset($_GET["errorea"]) ? $_GET["errorea"] : "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $erabiltzailea = isset($_POST["erabiltzailea"]) ? $_POST["erabiltzailea"] : "";
    $pasahitza = isset($_POST["pasahitza"]) ? $_POST["pasahitza"] : "";

    if ($erabiltzailea === $user && password_verify($pasahitza, $password)) {
        $mezua = "Login zuzena izan da.";
    } else {
        header("Location: 04ariketaLogin.php?errorea=" . urlencode("Erabiltzaile edo pasahitz okerra"));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>04 ariketa - Login</title>
    <style>
        .errorea { color: red; }
        .ondo { color: green; }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="04ariketaLogin.php" method="post">
        <label for="erabiltzailea">Erabiltzailea:</label>
        <input type="text" id="erabiltzailea" name="erabiltzailea">
        <br>
        <label for="pasahitza">Pasahitza:</label>
        <input type="password" id="pasahitza" name="pasahitza">
        <br>
        <button type="submit">Hasi saioa</button>
    </form>
    <?php if ($mezua !== ""): ?>
        <p class="<?php echo isset($_GET["errorea"]) ? "errorea" : "ondo"; ?>"><?php echo htmlspecialchars($mezua, ENT_QUOTES, "UTF-8"); ?></p>
    <?php endif; ?>
</body>
</html>