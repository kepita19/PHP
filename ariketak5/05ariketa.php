<?php
$zenbakiak = array();
$maiztasunak = array_fill(0, 50, 0);

for ($i = 0; $i < 50; $i++) {
    $zenbakia = rand(0, 49);
    $zenbakiak[] = $zenbakia;
    $maiztasunak[$zenbakia]++;
}
?>

<h2>Ausazko zenbakiak</h2>
<p><?php echo implode(', ', $zenbakiak); ?></p>

<h2>Zenbaki bakoitzaren maiztasuna</h2>
<table border="1">
    <tr>
        <th>Zenbakia</th>
        <th>Agerraldi kopurua</th>
    </tr>
    <?php foreach ($maiztasunak as $zenbakia => $kopurua): ?>
        <tr>
            <td><?php echo $zenbakia; ?></td>
            <td><?php echo $kopurua; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
