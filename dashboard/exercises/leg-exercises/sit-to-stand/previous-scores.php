 <?php include '../../../loggedin-head.php'; ?>

<?php


$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
 
  $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

$user = $_SESSION['userEmail'];  
      
     
	   //to prevent from mysqli injection  
        $user = stripcslashes($user);    
        $user = mysqli_real_escape_string($con, $user); 


 $sql1 = "select * from sit_to_stand where user = '$user' ORDER BY reg_date DESC";  
        $result1 = mysqli_query($con, $sql1);  
        $count1 = mysqli_num_rows($result1);


$sqlStats = "select * from sit_to_stand where user = '$user'";  
        $resultStats = mysqli_query($con, $sqlStats);  
        $countStats = mysqli_num_rows($resultStats);


$atLeast1reps5 = 0;
$atLeast1reps10 = 0;
$atLeast1sec30 = 0;
$atLeast1sec60 = 0;

$maxScoreSec30 = 0;
$maxScoreSec60 = 0;
	$minScoreSec30 = 5000000;
	$minScoreSec60 = 5000000;
$averageScoreSec30 = 0;
$averageScoreSec60 = 0;
    $minScoreSec30Date;
    $minScoreSec60Date;   
$maxScoreSec30Date;
$maxScoreSec60Date;


$maxTimeReps5 = 0;
$maxTimeReps10 = 0;
	$minTimeReps5 = 5000000;
	$minTimeReps10 = 5000000;
    $minTimeBoth = 50000000;
$averageTimeReps5 = 0;
$averageTimeReps10 = 0;
    $minTimeReps5Date;
    $minTimeReps10Date;    
$maxTimeReps5Date;
$maxTimeReps10Date;


$reps5ScoresCounter = 0;
$reps10ScoresCounter = 0;
$sec30ScoresCounter = 0;
$sec60ScoresCounter = 0;

		
	while($row = mysqli_fetch_array($resultStats)) {
		
			$actualScore = $row['score'];
			$actualVar = $row['variation'];
			$actualTime = $row['time'];
		
			if ($actualVar == "sec30") {
				if ($actualScore > $maxScoreSec30) {
					$maxScoreSec30 = $actualScore;
					$dateOfmaxS30=$row['reg_date'];
					 $maxScoreSec30Date = date('d-m-Y', strtotime($dateOfmaxS30));
				}
					if ($actualScore < $minScoreSec30) {
					$minScoreSec30 = $actualScore;
						$dateOfminS30=$row['reg_date'];
					 $minScoreSec30Date = date('d-m-Y', strtotime($dateOfminS30));
				}
				
				$averageScoreSec30 = $averageScoreSec30 + $actualScore;
				$sec30ScoresCounter++;
				$atLeast1sec30 = 1;
				
			} else if ($actualVar == "reps5") {
				
				if ($actualTime > $maxTimeReps5) {
					$maxTimeReps5 = $actualTime;
					$dateOfmaxTimeR5=$row['reg_date'];
					 $maxTimeReps5Date = date('d-m-Y', strtotime($dateOfmaxTimeR5));
				}
					if ($actualTime < $minTimeReps5) {
					$minTimeReps5 = $actualTime;
						$dateOfminTimeR5=$row['reg_date'];
					 $minTimeReps5Date = date('d-m-Y', strtotime($dateOfminTimeR5));
				}
				
				$averageTimeReps5 = $averageTimeReps5 + $actualTime;
				$reps5ScoresCounter++;
				$atLeast1reps5 = 1;
					
			} else if ($actualVar == "sec60") {
				if ($actualScore > $maxScoreSec60) {
					$maxScoreSec60 = $actualScore;
					$dateOfmaxS60=$row['reg_date'];
					 $maxScoreSec60Date = date('d-m-Y', strtotime($dateOfmaxS60));
				}
					if ($actualScore < $minScoreSec60) {
					$minScoreSec60 = $actualScore;
						$dateOfminS60=$row['reg_date'];
					 $minScoreSec60Date = date('d-m-Y', strtotime($dateOfminS60));
				}
				
				$averageScoreSec60 = $averageScoreSec60 + $actualScore;
				$sec60ScoresCounter++;
				$atLeast1sec60 = 1;
				
			} else if ($actualVar == "reps10") {
				
				if ($actualTime > $maxTimeReps10) {
					$maxTimeReps10 = $actualTime;
					$dateOfmaxTimeR10=$row['reg_date'];
					 $maxTimeReps10Date = date('d-m-Y', strtotime($dateOfmaxTimeR10));
				}
					if ($actualTime < $minTimeReps10) {
					$minTimeReps10 = $actualTime;
						$dateOfminTimeR10=$row['reg_date'];
					 $minTimeReps10Date = date('d-m-Y', strtotime($dateOfminTimeR10));
				}
				
				$averageTimeReps10 = $averageTimeReps10 + $actualTime;
				$reps10ScoresCounter++;
				$atLeast1reps10 = 1;
					
			} 
		
			}


if ($sec30ScoresCounter > 0) {
	$averageScoreSec30 = $averageScoreSec30 / $sec30ScoresCounter;
}

if ($sec60ScoresCounter > 0) {
	$averageScoreSec60 = $averageScoreSec60 / $sec60ScoresCounter;
}
		
if ($reps5ScoresCounter > 0) {
		$averageTimeReps5 = $averageTimeReps5 / $reps5ScoresCounter;
}

if ($reps10ScoresCounter > 0) {
		$averageTimeReps10 = $averageTimeReps10 / $reps10ScoresCounter;
}

?>

<main>
	
	<h1 id="pageTitle">Sit to Stand</h1>
	
<p style="text-align: center;">Check the previous scores you have achieved.</p>
	
	
	
	
	
		<div class="row">
				<div class="column1">
				<h3 style="text-align: center;">Statistics</h3>
				<?php if($countStats > 0) {
	
	if ($atLeast1reps5 == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (5 Repetitions)</th>
						<th>Max Time (5 Repetitions)</th>
		<th>Min Time (5 Repetitions)</th>
			<th>Average Time (5 Repetitions)</th>
					</tr>";
	
			echo "<tr><td>";
		
			echo $reps5ScoresCounter;
		
		echo "</td><td>";
			
			echo $maxTimeReps5;
	
			echo " (on ";
		echo $maxTimeReps5Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $minTimeReps5;
	
		echo " (on ";
		echo $minTimeReps5Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageTimeReps5;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
	
	
	
		if ($atLeast1reps10 == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (10 Repetitions)</th>
						<th>Max Time (10 Repetitions)</th>
		<th>Min Time (10 Repetitions)</th>
			<th>Average Time (10 Repetitions)</th>
					</tr>";
	
			echo "<tr><td>";
		
			echo $reps10ScoresCounter;
		
		echo "</td><td>";
			
			echo $maxTimeReps10;
	
			echo " (on ";
		echo $maxTimeReps10Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $minTimeReps10;
	
		echo " (on ";
		echo $minTimeReps10Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageTimeReps10;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
	
	
	
	
	
	if ($atLeast1sec30 == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (30 seconds)</th>
						<th>Max Time (30 seconds)</th>
		<th>Min Time (30 seconds)</th>
			<th>Average Time (30 seconds)</th>
					</tr>";
	
			echo "<tr><td>";
		
			echo $sec30ScoresCounter;
		
		echo "</td><td>";
			
			echo $maxScoreSec30;
	
			echo " (on ";
		echo $maxScoreSec30Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $minScoreSec30;
	
		echo " (on ";
		echo $minScoreSec30Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageScoreSec30;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
	
	
	
	
	if ($atLeast1sec60 == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (60 seconds)</th>
						<th>Max Time (60 seconds)</th>
		<th>Min Time (60 seconds)</th>
			<th>Average Time (60 seconds)</th>
					</tr>";
	
			echo "<tr><td>";
		
			echo $sec60ScoresCounter;
		
		echo "</td><td>";
			
			echo $maxScoreSec60;
	
			echo " (on ";
		echo $maxScoreSec60Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $minScoreSec60;
	
		echo " (on ";
		echo $minScoreSec60Date;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageScoreSec60;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
} else {
		echo "<p style='text-align: center;'>There are no scores saved yet.</p>";		
}
				?>
				
			</div>
	
	</div>
	
	
	
	
	
	
	
	
		<div class="row">

		<div class="column1">
		<h3 style="text-align: center;">Individual Scores</h3>
		<?php if($count1 > 0) {
	
	
	
	
	
	
	
	
	$noOfPages = intdiv($count1, 20);
	
	if (fmod($count1, 20) > 0) {
	$noOfPages = $noOfPages + 1;
	}
	
	$currentPage = 1;
	
	
	

	
	
	
	$x2 = 0;
	for ($x = 1; $x <= $noOfPages; $x++) {
	
		
		$sqlLoop = "select * from sit_to_stand where user = '$user' ORDER BY reg_date DESC LIMIT 20 OFFSET $x2";  
        $resultLoop = mysqli_query($con, $sqlLoop);  
        $countLoop = mysqli_num_rows($resultLoop);
		$x2 = $x2 + 20;
		
echo "<table style='display: none;' id='resultsTableNo";
echo $x;
echo "'>
					<tr>
					<th>Variation</th>
						<th>Score</th>
					<th>Time</th>
						<th>Date</th>
					</tr>";
		
		while($rowLoop = mysqli_fetch_array($resultLoop))
{
			
				
			
					echo "<tr><td>";
			if ($rowLoop['variation'] == "reps5") {
					echo "5 Repetitions";
					} else if ($rowLoop['variation'] == "reps10") {
					echo "10 Repetitions";
					} else if ($rowLoop['variation'] == "sec30") {
					echo "30 Seconds";
					} else if ($rowLoop['variation'] == "sec60") {
					echo "60 Seconds";
					}
			echo "</td><td>";
				echo $rowLoop['score'];
	echo "</td><td>";	
				echo $rowLoop['time'];
	echo "</td><td>";	
			
$dateOfX=$rowLoop['reg_date'];
echo date('H:i / d-m-Y', strtotime($dateOfX));
			
	echo "</td></tr>";
			
				
				}
echo "</table>";
	}
	
	
	
	
	
	
	
	
	
	
	
	echo "<br><p style='text-align: center;'> Page <span id='curActivePage'>";
	echo $currentPage;
	echo "</span> of ";
	echo $noOfPages;	
	echo "</p>";
			
			
			
			
			
			
			
			
			
			
			
			
		} 	else {
		echo "<p>There are no scores saved yet.</p>";		
}
				?>
			
	</div>


	</div>
	

<p id="navButtonsArea" style="text-align: center; display: none;">
<button id="prevTableButton">Prev</button>&nbsp;&nbsp;&nbsp;<button id="nextTableButton">Next</button>
</p>
	
	<hr>
	
<p style="text-align: center; margin-top: 50px;">
<a href="/dashboard/exercises/leg-exercises/index.php"><button>Lower-Limbs Exercises</button></a>
</p>
	
	<p style="text-align: center;">
<a href="/dashboard/previous-scores/index.php"><button>Upper/Lower-Limbs Previous Scores</button></a>
</p>


	
</main>
		
		<script>
		
			 var noOfTables = "<?php echo $noOfPages; ?>";
			if (noOfTables > 0) {
				var activeTable = 1;
			document.getElementById("resultsTableNo" + activeTable).style.display = "block";
				
				if (noOfTables > 1) {
				document.getElementById("navButtonsArea").style.display = "block";
				}
				
				document.getElementById("nextTableButton").addEventListener("click", goToNextTable);
				function goToNextTable() {
					if (activeTable < noOfTables) {
					document.getElementById("resultsTableNo" + activeTable).style.display = "none";
						activeTable++;
						document.getElementById("resultsTableNo" + activeTable).style.display = "block";
						document.getElementById("curActivePage").innerHTML = activeTable;
				}
				}	
						document.getElementById("prevTableButton").addEventListener("click", goToPrevTable);
				function goToPrevTable() {
					if (activeTable > 1) {
					document.getElementById("resultsTableNo" + activeTable).style.display = "none";
						activeTable--;
						document.getElementById("resultsTableNo" + activeTable).style.display = "block";
						document.getElementById("curActivePage").innerHTML = activeTable;
				}
				}
			}
			
		</script>



<?php include '../../../../main-footer.php';?>

		