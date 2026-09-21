<?php
$hilabeteak = array(
    "Urtarrila" => 31,
    "Otsaila" => 28,
    "Martxoa" => 31,
    "Apirila" => 30,
    "Maiatza" => 31,
    "Ekaina" => 30,
    "Uztaila" => 31,
    "Abuztua" => 31,
    "Iraila" => 30,
    "Urria" => 31,
    "Azaroa" => 30,
    "Abendua" => 31
);
?> 

<table border="1">
    <tr>
        <th>Hilabetea</th>
        <th>Egun kopurua</th>
    </tr>
    <?php foreach ($hilabeteak as $hilabetea => $egunak): ?>
        <tr>
            <td><?php echo $hilabetea; ?></td>
            <td><?php echo $egunak;  ?></td>
        </tr>
    <?php endforeach; ?>
</table>
