<?php
$pertsona1 = array(
	"izena" => "Ane",
	"abizena" => "Etxeberria",
	"NANa" => "12345678A"
);

$pertsona2 = array(
	"izena" => "Unai",
	"abizena" => "Gonzalez",
	"NANa" => "87654321B"
);

$pertsonak = array($pertsona1, $pertsona2);
?>

<table border="1">
	<thead>
		<tr>
			<th>Izena</th>
			<th>Abizena</th>
			<th>NANa</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pertsonak as $pertsona): ?>
			<tr>
				<td><?php echo $pertsona["izena"]; ?></td>
				<td><?php echo $pertsona["abizena"]; ?></td>
				<td><?php echo $pertsona["NANa"]; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
