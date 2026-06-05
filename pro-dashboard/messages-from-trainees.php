 	<?php include 'loggedin-head.php';?>

<?php

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
   $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

mysqli_set_charset($con, "utf8");

$userEmail = $_SESSION['userEmail'];  
      
        //to prevent from mysqli injection  
        $userEmail = stripcslashes($userEmail);    
        $userEmail = mysqli_real_escape_string($con, $userEmail); 


 $sql = "select * from trainers where email = '$userEmail'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);

 $sql2 = "select * from account_connections where trainer = '$userEmail' and verified = 'By Both'";  
        $result2 = mysqli_query($con, $sql2);  
        $count2 = mysqli_num_rows($result2);


 $sql3 = "select * from trainers_messages where trainer = '$userEmail' ORDER BY reg_date DESC";  
        $result3 = mysqli_query($con, $sql3);  
        $count3 = mysqli_num_rows($result3);

?>


<main id="messagesPage">
<h1 id="pageTitle">Trainees' Messages</h1>
	<div class="row">
		<div class="column2">
<h2 style="margin-top: 0px;">Messages Exchanged</h2>
			<p style="text-align: center;"><u>Here you can see the messages exchanged with trainees.</u></p>
			
				<?php if($count3 > 0) {
	
		
	$noOfPages = intdiv($count3, 10);
	
	if (fmod($count3, 10) > 0) {
	$noOfPages = $noOfPages + 1;
	}
	
	$currentPage = 1;
	

	$x2 = 0;
	for ($x = 1; $x <= $noOfPages; $x++) {
		
			$sqlLoop = "select * from trainers_messages where trainer = '$userEmail' ORDER BY reg_date DESC LIMIT 10 OFFSET $x2";  
        $resultLoop = mysqli_query($con, $sqlLoop);  
        $countLoop = mysqli_num_rows($resultLoop);
		$x2 = $x2 + 10;
	
		echo "<table style='display: none;' id='resultsTableNo";
echo $x;
echo "'>
<tr><th><strong>From</strong></th><th><strong>To</strong></th><th><strong>Message</strong></th><th><strong>Date</strong></th><th><strong>Actions</strong></th></tr>";
		while($rowLoop = mysqli_fetch_array($resultLoop))
{

	
						echo "<tr><td>";
		if ($rowLoop['message_from'] == $userEmail) {
			echo "You";
		} else {
			echo $rowLoop['message_from'];
		}
		echo "</td>";
		echo "<td>";
		if ($rowLoop['message_to'] == $userEmail) {
				echo "You";
		} else {
			echo $rowLoop['message_to'];
		}
		echo "</td>";
		echo "<td>";
		echo $rowLoop['message'];
		echo "</td><td>";
		echo date('d-m-Y H:i:s', strtotime($rowLoop['reg_date']));
				echo "</td>";
		echo "<td>";
	echo "<button id='" . $rowLoop['id'] . "' class='deleteMessage'>Delete</button>";
			echo "</td></tr>";
					
		}
echo "</table>";
		
		
	
		}
		echo "<br><p style='text-align: center;'> Page <span id='curActivePage'>";
	echo $currentPage;
	echo "</span> of ";
	echo $noOfPages;	
	echo "</p>";
} else {
echo "<p style='padding: 5px; border: 1px solid #fff;'>There are no messages exchanged with trainees.</p>";	
}
				?>
			
			<p id="navButtonsArea" style="text-align: center; display: none;">
<button id="prevTableButton">Prev</button>&nbsp;&nbsp;&nbsp;<button id="nextTableButton">Next</button>
</p>
			
	</div>
		<div class="column2">
		<h2 style="margin-top: 0px;">Connected Trainees' Accounts</h2>
					<p style="text-align: center;"><u>Here you can see the emails of the trainees with whom you can exchange messages.</u><br>To create a new connection with a trainee, use the relevant field in the "My Account" page.</p>
					
					
					
					<?php if($count2 > 0) {
	
	
	while($row = mysqli_fetch_array($result2)) {
echo "<table>";
	echo "<tr><th><strong>Trainee's Email</strong></th></tr>";
	
						echo "<tr><td>";
			echo $row['trainee'];
			echo "</td></tr>";
			echo "</table>";
			
		}

	
		} else {
echo "<p style='padding: 5px; border: 1px solid #fff;'>There are no verified connections with accounts of trainees.</p>";	
}
				?>
			
	</div>
		</div>
	
	
	
	
	
	<hr>
		<div class="row" style="flex-direction: column;">
				<div class="column1">
			<h2 style="margin-top: 0px;">Send new message</h2>
					<p><u>Here you can send new messages to connected trainees' accounts.</u></p>
					
					
					
				 <form style="flex-direction: column;
  padding: 20px;
  align-items: center;
  justify-content: space-between;" id="formaNewMessageToTrainee" name="formaNewMessageToTrainee" action="send-message-to-trainee-process.php"  method="POST">
					 <label for="traineesEmail">Email of Trainee</label><br>
					 <input style="padding: 10px;
  width: 100%;
  max-width: 400px; font-size: 15px;" id='traineesEmail' name='traineesEmail' type='email' placeholder='Email'><br>
					 <label for="messageToTrainee">Message to Trainee</label><br>
					 <textarea style="padding: 10px;
									  max-width: 100%; width: 400px; min-height: 200px; font-size: 15px;" id='messageToTrainee' name='messageToTrainee' placeholder='Message'></textarea><br><br>
					 <input id="sendButton" type="submit" value="Submit">
					</form>
					</div>
			</div>
	
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
			
			
				// delete messages
	
	var deleteMessages = document.getElementsByClassName("deleteMessage");
	
	for (let i = 0; i < deleteMessages.length; i++) {
		deleteMessages[i].addEventListener("click", function() {
			var rowID = deleteMessages[i].id;
		 $.ajax({
  method: "POST",
  url: "/pro-dashboard/delete-message-process.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('The message has been removed!');
     window.location.href='/pro-dashboard/messages-from-trainees.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/pro-dashboard/messages-from-trainees.php';
	 }
			 } 
}); 
			
		});
	}
			
		</script>


<?php include '../main-footer.php';?>
