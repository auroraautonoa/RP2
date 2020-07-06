<?php require_once 'header.php'; ?>

    <div class="div-image" id="div-image">
        <div class="div-text">
            <h1 style="font-size:50px">CROATIA EVENT CALENDAR</h1>
            <input type="text" placeholder="Search..">

            <!-- ode bi tribala ici tablica s prikazom svih evenata i ono sortiranje -->
            <!-- za sortiranje po gradu i temi mozemo ucitavat iz ovog txtboxa iznad, a za vrijeme mozda oni kalendar sta iskoci -->

        </div>
    </div>
	<?php echo $title ?>
	<br>
	<br>

<table>
    <tr>
        <th>Komentar</th>
	<th>Korisnik</th>
	<th>Datum</th>
	<th>Ocjena</th>


    </tr>
<form action="<?php echo 'index.php?rt=event/'.$title ?>" method="post">
<?php
	$i=0;
    foreach( $commentList as $comment ){
       	echo '<tr>' .
        '<td>'. $comment->opis .'</td>' .
	'<td>@'. $userList[$i] .'</td>' .
	'<td>'. $comment->vrijeme_objave .'</td>' .
	'<td>'.$comment->zvjezdice.'</td>';
        '</tr>';
	$i++;
    }

?>
        
</table>
<?php require_once 'footer.php';?>