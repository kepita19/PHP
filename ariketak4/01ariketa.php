<?php
$erab1 = array("Ane", "Garcia", "12345678Z");
$erab2 = array("Mikel", "Lopez", "87654321A");
?>

<table border="1">
    <tr>
        <th>Erabiltzailea</th>
        <th>Izena</th>
        <th>Abizena</th>
        <th>NANa</th>
    </tr>
    <tr>
        <td>1</td>
        <td><?php echo $erab1[0]; ?></td>
        <td><?php echo $erab1[1]; ?></td>
        <td><?php echo $erab1[2]; ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td><?php echo $erab2[0]; ?></td>
        <td><?php echo $erab2[1]; ?></td>
        <td><?php echo $erab2[2]; ?></td>
    </tr>
</table>
