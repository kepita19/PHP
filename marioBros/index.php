<?php
require_once __DIR__ . "/Mario.php";
require_once __DIR__ . "/Luigi.php";
require_once __DIR__ . "/Goomba.php";
require_once __DIR__ . "/Koopa.php";

$pertsonaiak = [
    new Mario("Mario", 100, 10, 3, "Sua bota"),
    new Luigi("Luigi", 100, 8, 4, "Altu salto egin"),
    new Goomba("Goomba", 40, 4, 2, 3, 5),
    new Koopa("Koopa", 60, 5, 3, 4, 6, true)
];
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Mario Bros</title>
</head>
<body>
    <h1>Mario Bros pertsonaiak</h1>

    <?php foreach ($pertsonaiak as $pertsonaia): ?>
        <h2><?php echo htmlspecialchars($pertsonaia->getIzena(), ENT_QUOTES, "UTF-8"); ?></h2>
        <p>Bizi-puntuak: <?php echo $pertsonaia->getBiziPuntuak(); ?></p>
        <p><?php echo htmlspecialchars($pertsonaia->mugitu(), ENT_QUOTES, "UTF-8"); ?></p>
        <p>Erasoaren indarra: <?php echo $pertsonaia->erasoEgin(); ?></p>

        <?php if ($pertsonaia instanceof Salto): ?>
            <p>Saltoaren indarra: <?php echo $pertsonaia->saltoEgin(); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
