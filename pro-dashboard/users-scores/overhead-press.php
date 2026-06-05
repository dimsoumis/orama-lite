 <?php include '../loggedin-head.php'; ?>

<?php


$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
 
  $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

$user = $_SESSION['chosenTraineeEmail'];   
      
     
	   //to prevent from mysqli injection  
        $user = stripcslashes($user);    
        $user = mysqli_real_escape_string($con, $user); 


 $sql1 = "select * from overhead_press where user = '$user' ORDER BY reg_date DESC";  
        $result1 = mysqli_query($con, $sql1);  
        $count1 = mysqli_num_rows($result1);


$sqlStats = "select * from overhead_press where user = '$user'";  
        $resultStats = mysqli_query($con, $sqlStats);  
        $countStats = mysqli_num_rows($resultStats);


$atLeast1right = 0;
$atLeast1left = 0;
$atLeast1both = 0;

$maxScoreRight = 0;
$maxScoreLeft = 0;
$maxScoreBoth = 0;
	$minScoreRight = 5000000;
	$minScoreLeft = 5000000;
    $minScoreBoth = 5000000;
$averageScoreRight = 0;
$averageScoreLeft = 0;
$averageScoreBoth = 0;
    $minScoreRightDate;
    $minScoreLeftDate;
    $minScoreBothDate;    
$maxScoreRightDate;
$maxScoreLeftDate;
$maxScoreBothDate;

$maxTimeRight = 0;
$maxTimeLeft = 0;
$maxTimeBoth = 0;
	$minTimeRight = 5000000;
	$minTimeLeft = 5000000;
    $minTimeBoth = 50000000;
$averageTimeRight = 0;
$averageTimeLeft = 0;
$averageTimeBoth = 0;
    $minTimeRightDate;
    $minTimeLeftDate;
    $minTimeBothDate;    
$maxTimeRightDate;
$maxTimeLeftDate;
$maxTimeBothDate;

$maxWeightRight = 0;
$maxWeightLeft = 0;
$maxWeightBoth = 0;
	$minWeightRight = 50000000;
	$minWeightLeft = 50000000;
    $minWeightBoth = 50000000;
$averageWeightRight = 0;
$averageWeightLeft = 0;
$averageWeightBoth = 0;
    $minWeightRightDate;
    $minWeightLeftDate;
    $minWeightBothDate;    
$maxWeightRightDate;
$maxWeightLeftDate;
$maxWeightBothDate;


$rightScoresCounter = 0;
$leftScoresCounter = 0;
$bothScoresCounter = 0;

		
	while($row = mysqli_fetch_array($resultStats)) {
		
			$actualScore = $row['score'];
			$actualHand = $row['hand'];
			$actualTime = $row['time'];
		    $actualWeight = $row['weight'];
		
			if ($actualHand == "right") {
				if ($actualScore > $maxScoreRight) {
					$maxScoreRight = $actualScore;
					$dateOfmaxR=$row['reg_date'];
					 $maxScoreRightDate = date('d-m-Y', strtotime($dateOfmaxR));
				}
					if ($actualScore < $minScoreRight) {
					$minScoreRight = $actualScore;
						$dateOfminR=$row['reg_date'];
					 $minScoreRightDate = date('d-m-Y', strtotime($dateOfminR));
				}
				
				if ($actualTime > $maxTimeRight) {
					$maxTimeRight = $actualTime;
					$dateOfmaxTimeR=$row['reg_date'];
					 $maxTimeRightDate = date('d-m-Y', strtotime($dateOfmaxTimeR));
				}
					if ($actualTime < $minTimeRight) {
					$minTimeRight = $actualTime;
						$dateOfminTimeR=$row['reg_date'];
					 $minTimeRightDate = date('d-m-Y', strtotime($dateOfminTimeR));
				}
				
				if ($actualWeight > $maxWeightRight) {
					$maxWeightRight = $actualWeight;
					$dateOfmaxWeightR=$row['reg_date'];
					 $maxWeightRightDate = date('d-m-Y', strtotime($dateOfmaxWeightR));
				}
					if ($actualWeight < $minWeightRight) {
					$minWeightRight = $actualWeight;
						$dateOfminWeightR=$row['reg_date'];
					 $minWeightRightDate = date('d-m-Y', strtotime($dateOfminWeightR));
				}
				
				$averageScoreRight = $averageScoreRight + $actualScore;
				$averageTimeRight = $averageTimeRight + $actualTime;
				$averageWeightRight = $averageWeightRight + $actualWeight;
				$rightScoresCounter++;
				$atLeast1right = 1;
				
			} else if ($actualHand == "left") {
			if ($actualScore > $maxScoreLeft) {
					$maxScoreLeft = $actualScore;
				$dateOfmaxL=$row['reg_date'];
					 $maxScoreLeftDate = date('d-m-Y', strtotime($dateOfmaxL));
				}
					if ($actualScore < $minScoreLeft) {
					$minScoreLeft = $actualScore;
					$dateOfminL=$row['reg_date'];
					 $minScoreLeftDate = date('d-m-Y', strtotime($dateOfminL));
				}	
				
				if ($actualTime > $maxTimeLeft) {
					$maxTimeLeft = $actualTime;
					$dateOfmaxTimeL=$row['reg_date'];
					 $maxTimeLeftDate = date('d-m-Y', strtotime($dateOfmaxTimeL));
				}
					if ($actualTime < $minTimeLeft) {
					$minTimeLeft = $actualTime;
						$dateOfminTimeL=$row['reg_date'];
					 $minTimeLeftDate = date('d-m-Y', strtotime($dateOfminTimeL));
				}
				
				if ($actualWeight > $maxWeightLeft) {
					$maxWeightLeft = $actualWeight;
					$dateOfmaxWeightL=$row['reg_date'];
					 $maxWeightLeftDate = date('d-m-Y', strtotime($dateOfmaxWeightL));
				}
					if ($actualWeight < $minWeightLeft) {
					$minWeightLeft = $actualWeight;
						$dateOfminWeightL=$row['reg_date'];
					 $minWeightLeftDate = date('d-m-Y', strtotime($dateOfminWeightL));
				}
				
				$averageScoreLeft = $averageScoreLeft + $actualScore;
				$averageTimeLeft = $averageTimeLeft + $actualTime;
				$averageWeightLeft = $averageWeightLeft + $actualWeight;
				$leftScoresCounter++;
				$atLeast1left = 1;
					
			} else  {
			if ($actualScore > $maxScoreBoth) {
					$maxScoreBoth = $actualScore;
				$dateOfmaxB=$row['reg_date'];
					 $maxScoreBothDate = date('d-m-Y', strtotime($dateOfmaxB));
				}
					if ($actualScore < $minScoreBoth) {
					$minScoreBoth = $actualScore;
					$dateOfminB=$row['reg_date'];
					 $minScoreBothDate = date('d-m-Y', strtotime($dateOfminB));
				}	
				
				if ($actualTime > $maxTimeBoth) {
					$maxTimeBoth = $actualTime;
					$dateOfmaxTimeB=$row['reg_date'];
					 $maxTimeBothDate = date('d-m-Y', strtotime($dateOfmaxTimeB));
				}
					if ($actualTime < $minTimeBoth) {
					$minTimeBoth = $actualTime;
						$dateOfminTimeB=$row['reg_date'];
					 $minTimeBothDate = date('d-m-Y', strtotime($dateOfminTimeB));
				}
				
				if ($actualWeight > $maxWeightBoth) {
					$maxWeightBoth = $actualWeight;
					$dateOfmaxWeightB=$row['reg_date'];
					 $maxWeightBothDate = date('d-m-Y', strtotime($dateOfmaxWeightB));
				}
					if ($actualWeight < $minWeightBoth) {
					$minWeightBoth = $actualWeight;
						$dateOfminWeightB=$row['reg_date'];
					 $minWeightBothDate = date('d-m-Y', strtotime($dateOfminWeightB));
				}
				
				$averageScoreBoth = $averageScoreBoth + $actualScore;
				$averageTimeBoth = $averageTimeBoth + $actualTime;
				$averageWeightBoth = $averageWeightBoth + $actualWeight;
				$bothScoresCounter++;
				$atLeast1both = 1;
					
			}
		
			}


if ($rightScoresCounter > 0) {
	$averageScoreRight = $averageScoreRight / $rightScoresCounter;
	$averageTimeRight = $averageTimeRight / $rightScoresCounter;
	$averageWeightRight = $averageWeightRight / $rightScoresCounter;
}
		
if ($leftScoresCounter > 0) {
	$averageScoreLeft = $averageScoreLeft / $leftScoresCounter;
		$averageTimeLeft = $averageTimeLeft / $leftScoresCounter;
	$averageWeightLeft = $averageWeightLeft / $leftScoresCounter;
}

if ($bothScoresCounter > 0) {
	$averageScoreBoth = $averageScoreBoth / $bothScoresCounter;
	$averageTimeBoth = $averageTimeBoth / $bothScoresCounter;
		$averageWeightBoth = $averageWeightBoth / $bothScoresCounter;
}

?>

<main>
	
	<h1 id="pageTitle">Overhead Press</h1>
	
	<p style="text-align: center;">Chosen Trainee: <u><?php echo $user; ?></u></p>
	
	<p style="text-align: center;"><a href="index.php"><button>Change Trainee</button></a></p>
	
<p style="text-align: center;">Check the scores that your trainee has achieved.</p>
	
	
		<div class="row">
				<div class="column1">
				<h3 style="text-align: center;">Statistics</h3>
				<?php if($countStats > 0) {
	
	if ($atLeast1right == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th rowspan='3'>No of Sessions</th>
						<th>Max Score (Right)</th>
		<th>Min Score (Right)</th>
			<th>Average Score (Right)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxScoreRight;
	
			echo " (on ";
		echo $maxScoreRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minScoreRight;
	
		echo " (on ";
		echo $minScoreRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageScoreRight;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Time (Right)</th>
		<th>Min Time (Right)</th>
			<th>Average Time (Right)</th>
					</tr>";
	
			echo "<tr><td rowspan='3'>";
					echo $rightScoresCounter;
		echo "</td><td>";
			
			echo $maxTimeRight;
	
			echo " (on ";
		echo $maxTimeRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minTimeRight;
	
		echo " (on ";
		echo $minTimeRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageTimeRight;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Weight (Right)</th>
		<th>Min Weight (Right)</th>
			<th>Average Weight (Right)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxWeightRight;
	
			echo " (on ";
		echo $maxWeightRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minWeightRight;
	
		echo " (on ";
		echo $minWeightRightDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageWeightRight;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
	
	
		if ($atLeast1left == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th rowspan='3'>No of Sessions</th>
						<th>Max Score (Left)</th>
		<th>Min Score (Left)</th>
			<th>Average Score (Left)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxScoreLeft;
	
			echo " (on ";
		echo $maxScoreLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minScoreLeft;
	
		echo " (on ";
		echo $minScoreLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageScoreLeft;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Time (Left)</th>
		<th>Min Time (Left)</th>
			<th>Average Time (Left)</th>
					</tr>";
	
			echo "<tr><td rowspan='3'>";
					echo $leftScoresCounter;
		echo "</td><td>";
			
			echo $maxTimeLeft;
	
			echo " (on ";
		echo $maxTimeLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minTimeLeft;
	
		echo " (on ";
		echo $minTimeLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageTimeLeft;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Weight (Left)</th>
		<th>Min Weight (Left)</th>
			<th>Average Weight (Left)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxWeightLeft;
	
			echo " (on ";
		echo $maxWeightLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minWeightLeft;
	
		echo " (on ";
		echo $minWeightLeftDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageWeightLeft;
			
			echo "</td></tr>";
		
			echo "</table>";
	
	}
	
	
	
	
	
		if ($atLeast1both == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th rowspan='3'>No of Sessions</th>
						<th>Max Score (Both)</th>
		<th>Min Score (Both)</th>
			<th>Average Score (Both)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxScoreBoth;
	
			echo " (on ";
		echo $maxScoreBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minScoreBoth;
	
		echo " (on ";
		echo $minScoreBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageScoreBoth;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Time (Both)</th>
		<th>Min Time (Both)</th>
			<th>Average Time (Both)</th>
					</tr>";
	
			echo "<tr><td rowspan='3'>";
					echo $bothScoresCounter;
		echo "</td><td>";
			
			echo $maxTimeBoth;
	
			echo " (on ";
		echo $maxTimeBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minTimeBoth;
	
		echo " (on ";
		echo $minTimeBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageTimeBoth;
			
			echo "</td></tr>";
		
			echo "<tr>
						<th>Max Weight (Both)</th>
		<th>Min Weight (Both)</th>
			<th>Average Weight (Both)</th>
					</tr>";
	
			echo "<tr><td>";
			
			echo $maxWeightBoth;
	
			echo " (on ";
		echo $maxWeightBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $minWeightBoth;
	
		echo " (on ";
		echo $minWeightBothDate;
			echo ")";
			
			echo "</td><td>";
			
			echo $averageWeightBoth;
			
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
	
		
		$sqlLoop = "select * from overhead_press where user = '$user' ORDER BY reg_date DESC LIMIT 20 OFFSET $x2";  
        $resultLoop = mysqli_query($con, $sqlLoop);  
        $countLoop = mysqli_num_rows($resultLoop);
		$x2 = $x2 + 20;
		
echo "<table style='display: none;' id='resultsTableNo";
echo $x;
echo "'>
					<tr>
					<th>Hand</th>
						<th>Score</th>
					<th>Time</th>
					<th>Weight</th>
						<th>Date</th>
					</tr>";
		
		while($rowLoop = mysqli_fetch_array($resultLoop))
{
			
				
			
					echo "<tr><td>";
					echo $rowLoop['hand'];
			echo "</td><td>";
				echo $rowLoop['score'];
	echo "</td><td>";	
				echo $rowLoop['time'];
	echo "</td><td>";	
				echo $rowLoop['weight'];
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
	
	<p style="text-align: center;">
<a href="user-scores.php"><button>Upper/Lower-Limbs Previous Scores</button></a>
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



<?php include '../../main-footer.php';?>

		