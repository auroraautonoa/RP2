<?php require_once 'header.php'; ?>

    <div class="div-image" id="div-image">
        <div class="div-text">
            <h1 style="font-size:50px">CROATIA EVENT CALENDAR</h1>
            <input type="text" placeholder="Search..">

            <!-- ode bi tribala ici tablica s prikazom svih evenata i ono sortiranje -->
            <!-- za sortiranje po gradu i temi mozemo ucitavat iz ovog txtboxa iznad, a za vrijeme mozda oni kalendar sta iskoci -->

        </div>
    </div>
	<table>
    <tr>
        <th>Event</th>
    </tr>
	<?php
	if( isset($_POST['username']) ){
		foreach( $eventList as $event ){
        		echo '<tr>' .
            		'<td><a href="index.php?rt=event/'.$event->name.'">'.$event->naslov.'</a></td>' .
             		'</tr>'; 
		}
	}
	else{
		foreach( $eventList as $event ){
        		echo '<tr>' .
            		'<td>'.$event->naslov.'</td>' .
             		'</tr>'; 
		}

	}
  
	?>
        
	</table>
	
<?php require_once 'footer.php';?>