 	<?php include '../loggedin-head.php';?>

<?php

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
   $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

$userEmail = $_SESSION['userEmail'];  
      
        //to prevent from mysqli injection  
        $userEmail = stripcslashes($userEmail);    
        $userEmail = mysqli_real_escape_string($con, $userEmail); 


 $sql = "select * from trainers where email = '$userEmail'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);

 $sql2 = "select * from account_connections where trainer = '$userEmail'  and verified = 'By Both'";  
        $result2 = mysqli_query($con, $sql2);  
        $count2 = mysqli_num_rows($result2);

?>


<main id="accountPage">
<h1 id="pageTitle">Users' Scores</h1>


		<div class="row" style="flex-direction: column;">
				<div class="column1">
			<h2 style="margin-top: 0px;">Connected Accounts</h2>
					<p><u>Choose the account of the user you want to check their performance.</u></p>
					
					
					
					<?php if($count2 > 0) {
	
	
	
	
	
	

		
echo "<table>";
	echo "<tr><th><strong>Trainee's Email</strong></th>
						<th><strong>Actions</strong></th></tr>";
	
		while($row = mysqli_fetch_array($result2))
{
						echo "<tr><td>";
			echo $row['trainee'];
					echo "</td><td>";
				echo "<button id='" . $row['id'] . "' class='chooseConnection'>Choose</button>";
		echo "</td></tr>";	
		}
echo "</table>";
	
		} 	else {
		echo "<p>There are no verified connections to trainees' accounts.</p>";		
}
				?>
			
					
					
			</div>
			
			</div>
</main>


<script>
		// choose connection
	
	var availableConnections = document.getElementsByClassName("chooseConnection");
	
	for (let i = 0; i < availableConnections.length; i++) {
		availableConnections[i].addEventListener("click", function() {
			var rowID = availableConnections[i].id;
		 $.ajax({
  method: "POST",
  url: "/pro-dashboard/users-scores/choose-connection.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('Connection has been chosen!');
     window.location.href='/pro-dashboard/users-scores/user-scores.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/pro-dashboard/users-scores/index.php';
	 }
			 } 
}); 
			
		});
	}
</script>

<?php include '../../main-footer.php';?>
