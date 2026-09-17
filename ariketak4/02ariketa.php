<?php
$produktuak = array("Galtzerdiak", "Txapela", "Jertsea", "Gerrikoak", "Botak");
$prezioak = array(25, 18, 40, 30, 55);
?>

<table border="1">
    <tr>
        <th>Produktua</th>
        <th>Prezioa</th>
    </tr>

    <?php
    for ($i = 0; $i < count($produktuak); $i++) {
        echo "<tr>";
        echo "<td>" . $produktuak[$i] . "</td>";
        echo "<td>" . $prezioak[$i] . " €</td>";
        echo "</tr>";
    }
    ?>
</table>
