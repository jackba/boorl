<?php 
	function showTable($array, $header) {
		?>
					<div>
						<table class="statistics">
							<tr>
								<th><?php echo $header?></th>
								<th></th>
							</tr>
							<?php foreach ($array as $instance) { ?>
							<tr>
								<td><?php echo $instance[0]?></td>
								<td class="number"><?php echo $instance[1]?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<?php 
	}
?>

<div class="tableContainer center">
	<?php 
		echo '<div class="wrapTwo">';
		showTable($statistics->getBrowsers(), "Browsers");
		showTable($statistics->getOperatingSystems(), "Operating Systems");
		echo '</div>';
		echo '<div class="wrapTwo">';
		showTable($statistics->getCountries(), "Countries");
		showTable($statistics->getReferers(), "Referers");
		echo '</div>';
	?>
</div>
