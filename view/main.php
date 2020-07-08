<?php require_once 'header.php'; ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <div class="div-image" id="div-image">
        <div class="div-text">
            <h1 style="font-size:50px">CROATIA EVENT CALENDAR</h1>
            <form action="index.php?rt=event/show_events" method="post">
                <input type="text" id="search" name="search" onkeyup="show_results()" placeholder="Search..">
	        </form>

            <!-- ode bi tribala ici tablica s prikazom svih evenata i ono sortiranje -->
            <!-- za sortiranje po gradu i temi mozemo ucitavat iz ovog txtboxa iznad, a za vrijeme mozda oni kalendar sta iskoci -->

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
				console.log(data.show_results);		
			},
			error: function(xhr, status, error) {
 				alert(xhr.responseText);
			}
	});
}
</script>