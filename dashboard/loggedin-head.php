 <?php
session_start();
if(!isset($_SESSION['userEmail'])){
   header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
	<title>ORAMA lite - Fitness and Rehabilitation Exercises</title>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
	<link rel="stylesheet" href="/styles/main.css">
	<link rel="stylesheet" href="/styles/responsive.css">
	
		<script src="/scripts/main.js" type="text/javascript"></script> 
		<script src="/scripts/sweetalert2.all.min.js" type="text/javascript"></script> 
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
	<body>
		
		<header style="margin-bottom: 80px;">
	<div id="logo"><img src="/images/logo-hor.png" /></div>
<nav id="mainNavigation">
	<a href="/dashboard/index.php">About</a>
	<a href="/dashboard/exercises/index.php">Exercises</a>
	<a href="/dashboard/previous-scores/index.php">Previous Scores</a>
	<a href="/dashboard/contact.php">Contact</a>
	<a class="logoutButton" href="/dashboard/logout.php">Log out</a>
	<a href="http://orama.uop.gr/" target="_blank" style="border-bottom: 2px solid #0665c7;
  padding: 5px;
  margin: 15px 0px 15px 15px;">ORAMA website</a>
</nav>
	
	<div id="mobileNav"><button onclick="showMobileMenu()">MENU</button></div>
	<nav id="mobileNavigation" class="noDis">
	<a href="/dashboard/index.php">About</a>
	<a href="/dashboard/exercises/index.php">Exercises</a>
	<a href="/dashboard/previous-scores/index.php">Previous Scores</a>
	<a href="/dashboard/contact.php">Contact</a>
	<a class="logoutButton" href="/dashboard/logout.php">Log out</a>
			<a href="http://orama.uop.gr/" target="_blank" style="border-bottom: 2px solid #0665c7;
  padding: 5px; margin: 15px 15px 15px 15px;">ORAMA website</a>
</nav>
			
			
			
			
				<a href="/dashboard/messages-from-trainers.php" style="position: absolute;
  top: 130px; right: 140px;"><button style="font-family: 'Roboto', sans-serif !important;
  font-size: 17px;
  background: #fff;
  border: 2px solid #fff;
  border-radius: 20px;
  padding: 10px;
  color: #0665c7;
  cursor: pointer;">Trainers' Messages</button></a>
			
			
			<a href="/dashboard/account.php" style="position: absolute;
  top: 130px; right: 10px;"><button style="font-family: 'Roboto', sans-serif !important;
  font-size: 17px;
  background: transparent;
  border: 2px solid #fff;
  border-radius: 20px;
  padding: 10px;
  color: #fff;
  cursor: pointer;">My Account</button></a>
</header>