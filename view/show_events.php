<?php require_once 'header.php'; ?>

	<div id="filter">
		<form action="index.php?rt=event/show_events" method="post">
			<select name="category">
				<option value = 'null' selected = "true">Odaberi kategoriju</option>
				<?php
					for($i = 0; $i < count($categoryList); $i++){
						echo '<option value="', $categoryList[$i], '">',$categoryList[$i],'</option>';
					}
				?>
			</select>
			<select name="city">
				<option value = 'null' selected = "true">Odaberi mjesto</option>
				<?php
					for($i = 0; $i < count($cityList); $i++){
						echo '<option value="', $cityList[$i], '">',$cityList[$i],'</option>';
					}
				?>
			</select>
			<select name="date">
				<option value = 'null' selected = "true">Odaberi datum</option>
				<?php
					for($i = 0; $i < count($dateList); $i++){
						echo '<option value="', $dateList[$i], '">',$dateList[$i],'</option>';
					}
				?>
			</select>
			<button type="submit">Filtriraj</button>
		</form>
	</div>
	<div id="events">
		<?php
			echo '<table>';
			for($i = 0; $i < count($eventList) / 5; $i++){
				echo '<tr>';
				for ($j = 0; $j < 5; $j++){
					if ($i * 5 + $j < count($eventList)){
						echo '<td>';
						echo '<a href="index.php?rt=event/'.$eventList[$i * 5+$j]->id.'">'.$eventList[$i * 5+$j]->naslov.'</a>'; 
						echo '<br>';
						echo $eventList[$i * 5+$j]->datum_pocetak . ' - ' . $eventList[$i+$j]->datum_kraj;
						echo '<br>';
						echo $eventList[$i * 5+$j]->mjesto;
						echo '<br>';
						echo '</td>';
					}
				}
				echo '</tr>';
			}
			echo '</table>';
		?>
	</div>
	
	
<?php require_once 'footer.php';?>