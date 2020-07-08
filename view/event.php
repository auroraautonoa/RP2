<?php require_once 'header.php'; ?>

<div id = "event details">
	<h1><?php echo $event->naslov;?></h1>
	Mjesto održavanja: <?php if ($event->mjesto != '') echo $event->mjesto . ', '; echo $event->grad?>
	<br>
	Početak: <?php echo $event->datum_pocetak . ' u ' . $event->vrijeme_pocetak;?>
	<br>
	Kraj: <?php echo $event->datum_kraj . ' u ' . $event->vrijeme_kraj;?>
	<br>
	Dolazi: <?php echo $event->dolazi ?>
	<?php if (isset($_SESSION['username'])) if( $coming == 0 ){ 
		echo '<form action="index.php?rt=event/'.$event->id.'" method="post">';
		echo '<button type="submit" name="dolazim">Dolazim!</button></form>';
	       }
	      else{
			echo "<br><br>Dolazim na ovaj event!";
		}
 	?>
	<br><br>
	Opis događaja: <?php echo $event->opis ?>
</div>

<br>
<br>
<table>
    <tr>
    <th>Komentar</th>
	<th>Korisnik</th>
	<th>Datum i vrijeme</th>
	<th>Ocjena</th>


    </tr>
<?php
	$i=0;
    foreach( $commentList as $comment ){
       	echo '<tr>' .
		   '<td style="text-align:center">'. $comment->opis .'</td>' .
		   '<td style="text-align:center">@'. $userList[$i] .'</td>' .
		   '<td style="text-align:center">'. $comment->vrijeme_objave .'</td>' .
		   '<td style="text-align:center">'.$comment->zvjezdice.'</td>'.
        '</tr>';
	$i++;
    }

?>
        
</table>

<?php 
if (isset($_SESSION['username'])){
?>
<form action="<?php echo 'index.php?rt=event/'.$event->id ?>" method="post">
<textarea name="comment" rows = "10" cols = "50" placeholder="Napišite komentar..."></textarea>
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

<div id="forecast"></div>

<script>
	var daysnum = 3;
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