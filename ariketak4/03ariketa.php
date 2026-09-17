<?php
$produktuak = array("Galtzerdiak", "Txapela", "Jertsea", "Gerrikoak", "Botak");
$prezioak = array(25, 18, 40, 30, 55);
$beherapena = 20;
$prezioZaharrak = $prezioak;

for ($i = 0; $i < count($prezioak); $i++) {
    $prezioak[$i] = $prezioak[$i] - ($prezioak[$i] * $beherapena / 100);
}
?>

<table border="1">
    <tr>
        <th>Produktua</th>
        <th>Prezio zaharra</th>
        <th>Prezio berria</th>
    </tr>

    <?php
    for ($i = 0; $i < count($produktuak); $i++) {
        echo "<tr>";
        echo "<td>" . $produktuak[$i] . "</td>";
        echo "<td>" . $prezioZaharrak[$i] . " €</td>";
        echo "<td>" . $prezioak[$i] . " €</td>";
        echo "</tr>";
    }
    ?>
</table>
