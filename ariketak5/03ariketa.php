<?php
$astekoEgunak = array(
    "Astelehena" => 1,
    "Asteartea" => 2,
    "Asteazkena" => 3,
    "Osteguna" => 4,
    "Ostirala" => 5,
    "Larunbata" => 6,
    "Igandea" => 7
);

$batura = array_sum($astekoEgunak);
$batezbestekoa = $batura / count($astekoEgunak);
?>

<table border="1">
    <tr>
        <th>Asteko eguna</th>
        <th>Balioa</th>
    </tr>
    <?php foreach ($astekoEgunak as $eguna => $balioa): ?>
        <tr>
            <td><?php echo $eguna; ?></td>
            <td><?php echo $balioa; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p>Batura: <?php echo $batura; ?></p>
<p>Batezbestekoa: <?php echo $batezbestekoa; ?></p>
