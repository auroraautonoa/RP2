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
	<br><br>
	Opis događaja: <?php echo $event->opis ?>
	<?php if( $coming == 0 ){ 
		echo '<form action="index.php?rt=event/'.$event->id.'" method="post">';
		echo '<button type="submit" name="dolazim">Dolazim!</button></form>';
	       }
	      else{
			echo "<br><br>Dolazim na ovaj event!";
		}
 	?>
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

<?php require_once 'footer.php';?>