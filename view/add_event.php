<?php require_once 'header.php'; ?>

	<form action="index.php?rt=event/add_event" method="post">
    <div class="div-main" >
        <div class="div-table">
        <table>
		<tr>
			<td> Ime eventa: </td>
			<td><input type="text" name="naslov" /></td>
        </tr>
        <tr>
			<td> Kategorija: </td>
			<td><input type="text" name="kategorija" /></td>
		</tr>
		<tr>
			<td> Opis: </td>
			<td> <textarea name="opis" rows = "10" cols = "50">Ovdje napišite kratki opis...</textarea> </td>
		</tr>
		<tr>
			<td> Mjesto održavanja: </td>
			<td><input type="text" name="mjesto" /></td>
		</tr>
		<tr>
			<td> Datum početka događaja: </td>
			<td><input type="date" name="datum_pocetak" /></td>
		</tr>
		<tr>
			<td> Datum kraja događaja: </td>
			<td><input type="date" name="datum_kraj" /></td>
		</tr>
		<tr>
			<td> Vrijeme početka događaja: </td>
			<td><input type="time" name="vrijeme_pocetak" /></td>
		</tr>
		<tr>
			<td> Vrijeme kraja događaja: </td>
			<td><input type="time" name="vrijeme_kraj" /></td>
		</tr>
    	</table>
    <br> &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    <button class="button" id="btnPrijava" type="submit">KREIRAJ DOGAĐAJ</button>	
    	</div>
    </div>
	</form>
	<?php echo $message ?>
<?php require_once 'footer.php';?>