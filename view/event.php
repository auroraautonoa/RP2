<?php require_once 'header.php'; ?>

<div id = "event details" class="div-event">
	<table class="table-event">
		<h1 style="text-align:center; color:#cccccc"><?php echo $event->naslov;?></h1> <br> 
		<tr><td>
		<?php if ($event->mjesto != '') echo $event->mjesto . ', '; echo $event->grad?>
		&nbsp
		( <?php echo $event->datum_pocetak . ' u ' . $event->vrijeme_pocetak;?>
		
		, <?php echo $event->datum_kraj . ' u ' . $event->vrijeme_kraj;?>
		)
</td></tr>
<tr><td style="background-color: #cccccc">
		Dolazi: <?php echo $event->dolazi ?>
		<?php if (isset($_SESSION['username'])){
		        if( $coming == 0 ){ 
			   echo '<form action="index.php?rt=event/'.$event->id.'" method="post">';
			   echo '<button type="submit" name="dolazim">Dolazim!</button></form>';
			}
			else{
				echo "<br><br>Dolazim na ovaj event!";
				echo '<form action="index.php?rt=event/'.$event->id.'" method="post">';
			   	echo '<button type="submit" name="ne_dolazim">Ne dolazim!</button></form>';
			}
		  }
		?> </td></tr>
		<tr><td>
		<?php echo $event->opis ?>
		</td></tr>
	</table>

<br>

<table>
<?php
	$i=0;
    foreach( $commentList as $comment ){
       	echo '<tr>' .
		   '<td style="text-align:center; color: #cccccc; font-size:16px; font-weight: 600">@'. $userList[$i].' '.$comment->vrijeme_objave.'</td></tr>' .
		   '<tr> <td style="text-align:right; color:#cccccc">'. $comment->opis .'</td>' .
		   '<td style="text-align:right; color:#cccccc">'.$comment->zvjezdice.'</td>'.
        '</tr>';
	$i++;
	}
?>   
</table>
<br>
<?php 
if (isset($_SESSION['username'])){
?>
<form action="<?php echo 'index.php?rt=event/'.$event->id ?>" method="post">
<textarea name="comment" rows = "10" cols = "60" placeholder="Napišite komentar..."></textarea>
<br>
<input type="radio" id="1" name="ocjena" value="1">
<label for="1">1</label>
<input type="radio" id="2" name="ocjena" value="2">
<label for="2">2</label>
<input type="radio" id="3" name="ocjena" value="3" checked = "checked">
<label for="3" >3</label>
<input type="radio" id="4" name="ocjena" value="4">
<label for="4">4</label>
<input type="radio" id="5" name="ocjena" value="5">
<label for="5">5</label>
<button type = "submit">Objavi komentar</button>
</form>
<?php
}
?>
</div>


<div id="forecast" class="div-event-for"></div>

<script>
	var daysnum = 1;
	$.ajax(
	{
		url:"https://api.weatherbit.io/v2.0/forecast/daily",
		data:{
			key: "271f359aee6a4ac0af9a636dd08c6ba1",
			city: '<?php echo $event->grad;?>',
			days: daysnum,
			country: 'Croatia'
		},
		type:"GET",
		dataType: "json",
		success: function(data){
			$('#forecast').append("<br><br><br>");
			$('#forecast').append("<br><br>");


			for (var i = 0; i < daysnum; i++){
				$('#forecast').append("Prognoza za  <?php echo $event->grad;?> ", data.data[i]['datetime'], ":<br>");
				$('#forecast').append("<span style='padding-left:2em'>Najviša temperatura: ", data.data[i]['max_temp'], "</span><br>");
				$('#forecast').append("<span style='padding-left:2em'>Najniža temperatura: ", data.data[i]['low_temp'], "</span><br>");
				$('#forecast').append("<span style='padding-left:2em'>Prosječna temperatura: ", data.data[i]['temp'], "</span><br>");
				$('#forecast').append("<span style='padding-left:2em'>Smjer vjetra: ", data.data[i]['wind_cdir_full'], "</span><br>");
				$('#forecast').append("<span style='padding-left:2em'>Brzina vjetra: ", data.data[i]['wind_spd'], " m/s</span><br>");
				$('#forecast').append("<span style='padding-left:2em'>Opis vremena: ", data.data[i]['weather']['description'], "</span><br><br>");
			}
		},
		error: function(){
			console.log('Greska u Ajaxu!');
        }
	});
</script>

<?php require_once 'footer.php';?>