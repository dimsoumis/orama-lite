
<?php include '../loggedin-head.php';?>

<?php $userEmail = $_SESSION['chosenTraineeEmail']; ?>
<main>
	
	<h1 id="pageTitle">User's Scores</h1>
	
	
	<p style="text-align: center;">Chosen Trainee: <u><?php echo $userEmail; ?></u></p>
	
	<p style="text-align: center;"><a href="index.php"><button>Change Trainee</button></a></p>
	
<p style="text-align: center;">Choose the exercises in which you want to check your trainee's performances.</p>
	
	<div class="row">
		
		<div class="column4" style="justify-content: center;">
			<h2>Upper-Limbs</h2>
		</div>
		<div class="column4">
			<a href="bicep-curls.php"><img src="/images/bicep-curls.png" /></a>
				<a href="bicep-curls.php"><h3 style="text-align: center;">Bicep curls</h3></a>
			<a href="bicep-curls.php"><button style="margin: 0px 0px 10px 0px;">Check Scores</button></a>
		
	</div>
		<div class="column4">
			<a href="overhead-press.php"><img src="/images/overhead-press.png" /></a>
				<a href="overhead-press.php"><h3 style="text-align: center;">Overhead press</h3></a>
				<a href="overhead-press.php"><button style="margin: 0px 0px 10px 0px;">Check Scores</button></a>
		
	</div>
			<div class="column4">
			<a href="lateral-raises.php"><img src="/images/lateral-raises.png" /></a>
				<a href="lateral-raises.php"><h3 style="text-align: center;">Lateral raises</h3></a>
					<a href="lateral-raises.php"><button style="margin: 0px 0px 10px 0px;">Check Scores</button></a>
		
	</div>
	

	</div>
	
			
<hr>
	
	<div class="row">
			<div class="column4" style="justify-content: center;">
			<h2>Lower-Limbs</h2>
		</div>
		<div class="column4">
			<a href="sit-to-stand.php"><img style="width: 350px;" src="/images/sit-to-stand.png" /></a>
				<a href="sit-to-stand.php"><h3 style="text-align: center;">Sit to Stand</h3></a>
			
			
			<a href="sit-to-stand.php"><button style="margin: 0px 0px 10px 0px;">Check Scores</button></a>
		
	</div>
		<div class="column4">
					<a href="1-foot-balance.php"><img style="width: 350px;" src="/images/legs-and-balance.png" /></a>
				<a href="1-foot-balance.php"><h3 style="text-align: center;">1 Foot Balance</h3></a>
				<a href="1-foot-balance.php"><button style="margin: 0px 0px 10px 0px;">Check Scores</button></a>
			
	</div>
			<div class="column4">
			&nbsp;
		</div>
	

	</div>
	
</main>



<?php include '../../main-footer.php';?>


