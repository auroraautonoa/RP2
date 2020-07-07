<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	</head>
	<style>
	  /* Popup container - can be anything you want */
	  .popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
  .popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
  .popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
  .popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
  @-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

  @keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}

  .sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

  .sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

  .sidebar a:hover {
  color: #f1f1f1;
}

  .sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

  .openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

  .openbtn:hover {
  background-color: #444;
}

  #main {
  transition: margin-left .5s;
  padding: 16px;
}
	</style>
		<title>Croatia Event Calendar</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
		<ul>
		<div id="mySidebar" class="sidebar">
 	 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#10005</a>
 	 <a href="#">About</a>
 	 <a href="#">Services</a>
 	 <a href="#">Clients</a>
 	 <a href="#">Contact</a>
		</div>
            <div id="main">
  		<button class="openbtn" onclick="openNav()">&#9776 Open Sidebar</button>  
	    </div>
	    <?php 
	    	echo '<form action="index.php?rt=event/show_events" method="post">';
            	echo '<li><button type="submit">EVENT CALENDAR</button></li></form>';
		
	    ?>
            
            <?php if( isset( $_SESSION['username'] ) ){
		    echo '<form action="index.php?rt=event/logout" method="post">';
                    echo '<li style="float:right"><button type="submit">Log out</button></li></form>'; 
                    echo '<li style="float:right"><i class="fa fa-user-circle" style="font-size:30px; margin-top:10px;"></i></li>';
                  }
                  else
                  {
		    echo '<form action="index.php?rt=login/login" method="post">';
		    echo '<button style="float:right" type="submit">Prijava</button></form>';
                    //echo '<li style="float:right"><a href="prijava.php">Prijava</a></li>';
                    //echo '<li style="float:right"><a href="registracija.php">Registracija</a></li>';
		    echo '<form action="index.php?rt=login/register" method="post">';
		    echo '<button style="float:right" type="submit">Registracija</button></form>';
                    echo '<li style="float:right"><i class="fa fa-user-circle" style="font-size:30px; margin-top:10px;"></i></li>';
                  }
            
            ?>
        </ul>
	</head>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
	<body>
	