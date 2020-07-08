<?php require_once 'header.php'; ?>

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