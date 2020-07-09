<?php require_once 'header.php'; ?>

	<div id="filter" class="div-navigation-bar">
		<form action="index.php?rt=event/show_events" method="post">
			<select class="dropdown" name="category">
				<option value = 'null' selected = "true">Odaberi kategoriju</option>
				<?php
					for($i = 0; $i < count($categoryList); $i++){
						echo '<option value="', $categoryList[$i], '">',$categoryList[$i],'</option>';
					}
				?>
			</select>
			&nbsp &nbsp 
			<select class="dropdown" name="city">
				<option value = 'null' selected = "true">Odaberi grad</option>
				<?php
					for($i = 0; $i < count($cityList); $i++){
						echo '<option value="', $cityList[$i], '">',$cityList[$i],'</option>';
					}
				?>
			</select>
			&nbsp &nbsp 
			<select class="dropdown" name="date">
				<option value = 'null' selected = "true">Odaberi datum</option>
				<?php
					for($i = 0; $i < count($dateList); $i++){
						echo '<option value="', $dateList[$i], '">',$dateList[$i],'</option>';
					}
				?>
			</select>
			&nbsp &nbsp 

			<button type="submit" class="btnF">Filtriraj</button>
		</form>
	</div>
	<div id="events"  class="all-events">
		<br>
			<table class="table" style="margin-left: 30%">
			<?php
			for($i = 0; $i < count($eventList) / 5; $i++){
				for ($j = 0; $j < 5; $j++){
					echo '<tr>';
					if ($i * 5 + $j < count($eventList)){
						echo '<td><i class="fa fa-stop" style="color: #bfbfbf; font-size: 1.73em"></i> ';
						echo '<a href="index.php?rt=event/'.$eventList[$i * 5+$j]->id.'">'.$eventList[$i * 5+$j]->naslov.'</a>'; 
						echo '<br>';
						echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
						echo $eventList[$i * 5+$j]->datum_pocetak . ' - ' . $eventList[$i+$j]->datum_kraj;
						echo '<br>';
						echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
						echo $eventList[$i * 5+$j]->grad;
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