<?php require_once 'header.php'; ?>

    <div class="div-image" id="div-image">
        <div class="div-text">
            <h1 style="font-size:50px">CROATIA EVENT CALENDAR</h1>
            <form action="index.php?rt=event/show_events" method="post">
                <input type="text" name="search" placeholder="Search..">
	        </form>

            <!-- ode bi tribala ici tablica s prikazom svih evenata i ono sortiranje -->
            <!-- za sortiranje po gradu i temi mozemo ucitavat iz ovog txtboxa iznad, a za vrijeme mozda oni kalendar sta iskoci -->

        </div>
    </div>
	<?php echo $message ?>
<?php require_once 'footer.php';?>