<?php require_once 'header.php'; ?>

    <style>
	ul.x{
		position: absolute;
		top:110%;

	}
    </style>
    <div class="div-image" id="div-image">
        <div class="div-text" id="div">
            <h1 style="font-size:50px">CROATIA EVENT CALENDAR</h1>
            <form action="index.php?rt=event/show_events" method="post">
                <input type="text" id="search" name="search" onkeyup="show_results()" placeholder="Search.." autocomplete="off">
	    </form>

            <!-- ode bi tribala ici tablica s prikazom svih evenata i ono sortiranje -->
            <!-- za sortiranje po gradu i temi mozemo ucitavat iz ovog txtboxa iznad, a za vrijeme mozda oni kalendar sta iskoci -->

	<ul class="x" id="myUL">
		
	</ul>

        </div>
	
    </div>
	<?php echo $message ?>
<?php require_once 'footer.php';?>

<script>

function show_results(){
	input = document.getElementById("search");
	console.log(input.value);
	$.ajax({
			url: '../projekt/model/show_results.php',
			data:
			{
				send: input.value
			},
			type: "GET",
			dataType: "json",
			success: function(data){
				$('#myUL').html('');
				for(i=0; i<data.show_results.length; i++){
					console.log(data.show_results[i]);
					$('#myUL').append('<li style="cursor:pointer" onclick="obradi('+i+')" id="'+i+'">'+data.show_results[i]+'</li><br>');
				}
		
			},
			error: function(xhr, status, error) {
 				alert(xhr.responseText);
			}
	});

}
function obradi(x){
	li = document.getElementById(x);
	input = document.getElementById("search");
	input.value = li.innerText;
}

</script>