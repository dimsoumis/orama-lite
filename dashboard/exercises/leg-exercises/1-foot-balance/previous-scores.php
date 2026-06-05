
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


 $sql1 = "select * from one_foot_balance where user = '$user' ORDER BY reg_date DESC";  
        $result1 = mysqli_query($con, $sql1);  
        $count1 = mysqli_num_rows($result1);


$sqlStats = "select * from one_foot_balance where user = '$user'";  
        $resultStats = mysqli_query($con, $sqlStats);  
        $countStats = mysqli_num_rows($resultStats);


$atLeast1right = 0;
$atLeast1left = 0;

$maxTimeRight = 0;
$maxTimeLeft = 0;
	$minTimeRight = 5000000;
	$minTimeLeft = 5000000;
$averageTimeRight = 0;
$averageTimeLeft = 0;
    $minTimeRightDate;
    $minTimeLeftDate;  
$maxTimeRightDate;
$maxTimeLeftDate;

$rightScoresCounter = 0;
$leftScoresCounter = 0;

		
	while($row = mysqli_fetch_array($resultStats)) {
		
			$actualLeg = $row['leg'];
			$actualTime = $row['time'];
		
			if ($actualLeg == "right") {
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
				
				$averageTimeRight = $averageTimeRight + $actualTime;
				$rightScoresCounter++;
				$atLeast1right = 1;
				
			} else if ($actualLeg == "left") {
		
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

				$averageTimeLeft = $averageTimeLeft + $actualTime;
				$leftScoresCounter++;
				$atLeast1left = 1;
					
			} 
			}


if ($rightScoresCounter > 0) {
	$averageTimeRight = $averageTimeRight / $rightScoresCounter;
}
		
if ($leftScoresCounter > 0) {
		$averageTimeLeft = $averageTimeLeft / $leftScoresCounter;
}

?>

<main>
	
	<h1 id="pageTitle">1 Foot Balance</h1>
	
<p style="text-align: center;">Check the previous scores you have achieved.</p>
	
	
	
	
	
		<div class="row">
				<div class="column1">
				<h3 style="text-align: center;">Statistics</h3>
				<?php if($countStats > 0) {
	
	if ($atLeast1right == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (Right)</th>
						<th>Max Time (Right)</th>
		<th>Min Time (Right)</th>
			<th>Average Time (Right)</th>
					</tr>";
	
			echo "<tr><td>";
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
		
			echo "</table>";
	
	}
	
	
	
		if ($atLeast1left == 1) {

		echo "<table style='margin: 20px 0px;'>
					<tr>
					<th>No of Sessions (Left)</th>
						<th>Max Time (Left)</th>
		<th>Min Time (Left)</th>
			<th>Average Time (Left)</th>
					</tr>";
	
			echo "<tr><td>";
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
	
		
		$sqlLoop = "select * from one_foot_balance where user = '$user' ORDER BY reg_date DESC LIMIT 20 OFFSET $x2";  
        $resultLoop = mysqli_query($con, $sqlLoop);  
        $countLoop = mysqli_num_rows($resultLoop);
		$x2 = $x2 + 20;
		
echo "<table style='display: none;' id='resultsTableNo";
echo $x;
echo "'>
					<tr>
					<th>Leg</th>
					<th>Time</th>
						<th>Date</th>
					</tr>";
		
		while($rowLoop = mysqli_fetch_array($resultLoop))
{
			
				
			
					echo "<tr><td>";
					echo $rowLoop['leg'];
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

		