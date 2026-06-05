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

$userEmail = $_SESSION['userEmail'];  
      
        //to prevent from mysqli injection  
        $userEmail = stripcslashes($userEmail);    
        $userEmail = mysqli_real_escape_string($con, $userEmail); 


 $sql = "select * from trainees where email = '$userEmail'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);

 $sql2 = "select * from account_connections where trainee = '$userEmail'";  
        $result2 = mysqli_query($con, $sql2);  
        $count2 = mysqli_num_rows($result2);

?>


<main id="accountPage">
<h1 id="pageTitle">My Account</h1>
	<div class="row">
		<div class="column2" style="align-items: start;">
<h2 style="margin-top: 0px;">Account Information</h2>
			<p>Check your account information and make sure everything is correct!</p>
			
			<a href="change-password.php"><button style="margin: 10px 0px;">Change Password</button></a><br><br>
	<a href="change-information.php"><button style="margin: 10px 0px;">Change Information</button></a><br><br>
			<a href="delete-account.php"><button style="margin: 10px 0px;">Delete Account</button></a><br><br>
	</div>
		<div class="column2" style="align-items: start;">
	<?php if($count > 0) {
	
	
	
	
	
	

		
echo "<table>";
		
		while($row = mysqli_fetch_array($result))
{
			
	
					echo "<tr><td><strong>First Name</strong></td><td>";
					echo $row['firstname'];
			echo "</td></tr><tr><td><strong>Last Name</strong></td><td>";
			echo $row['lastname'];
			echo "</td></tr><tr><td><strong>Email</strong></td><td>";
				echo $row['email'];
			echo "</td></tr><tr><td><strong>Date of Birth</strong></td><td>";
			echo date('d-m-Y', strtotime($row['date_of_birth']));
			echo "</td></tr><tr><td><strong>Gender</strong></td><td>";
				echo $row['gender'];
	echo "</td></tr>";
			
		}
echo "</table>";
	
		} 	else {
		echo "<p>There are no information.</p>";		
}
				?>
			
	</div>
		</div>
	<hr>
		<div class="row" style="flex-direction: column;">
				<div class="column1">
			<h2 style="margin-top: 0px;">Connected Accounts</h2>
					<p><u>Here you can manage the email accounts that have access to your data.</u></p>
					
					
					
					<?php if($count2 > 0) {
	
	
	
	
	
	

		
echo "<table>";
	echo "<tr><th><strong>Trainer's Email</strong></th>
						<th><strong>Status</strong></th>
						<th><strong>Actions</strong></th></tr>";
	
		while($row = mysqli_fetch_array($result2))
{
						echo "<tr><td>";
					echo $row['trainer'];
			echo "</td><td>";
			if ($row['verified'] == "By Trainee") {
			echo "Invitation Sent";
					echo "</td><td>";
				echo "<button id='" . $row['id'] . "' class='cancelInvitation'>Cancel Invitation</button>";
			} 	else if ($row['verified'] == "By Trainer") {
			echo "Invitation Received";
					echo "</td><td>";
				echo "<button id='" . $row['id'] . "' class='acceptInvitation'>Accept</button>
				<button id='" . $row['id'] . "' class='denyInvitation'>Deny</button>";
			} else if ($row['verified'] == "By Both") {
			echo "Connection Established";
					echo "</td><td>";
				echo "<button id='" . $row['id'] . "' class='cancelConnection'>Cancel Connection</button>";
			} 
		echo "</td></tr>";	
		}
echo "</table>";
	
		} 	else {
		echo "<p>There are no connections to trainers' accounts.</p>";		
}
				?>
			
					
					
			</div>
				<div class="column1">
					<hr style="max-width: 300px;
  margin: 20px auto 30px auto;
  height: 1px;">
					<button id="createNewCon" onclick="showFormNewConnections()">Create New Connection</button>
					
					
				 <form style="display: none;
  flex-direction: column;
  padding: 20px;
  height: 120px;
  align-items: center;
  justify-content: space-between;" id="formaNewConnection" name="formaNewConnection" action="create-new-connection-process.php"  method="POST">
					 <label for="trainersEmail">Add the email of the account you want to connect with.</label>
					 <input style="padding: 10px;
  width: 100%;
  max-width: 400px;" id='trainersEmail' name='trainersEmail' type='email' placeholder='Email'>
					 <input id="sendButton" type="submit" value="Submit">
					</form>
					</div>
			</div>
</main>

<script>
	function showFormNewConnections() {
		document.getElementById("createNewCon").style.display = "none";
			document.getElementById("formaNewConnection").style.display = "flex";
	}
	
	
	// cancel invitations
	
	var cancelInvitations = document.getElementsByClassName("cancelInvitation");
	
	for (let i = 0; i < cancelInvitations.length; i++) {
		cancelInvitations[i].addEventListener("click", function() {
			var rowID = cancelInvitations[i].id;
		 $.ajax({
  method: "POST",
  url: "/dashboard/cancel-invitation-process.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('Invitation has been canceled!');
     window.location.href='/dashboard/account.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/dashboard/account.php';
	 }
			 } 
}); 
			
		});
	}
	
		// cancel connections
	
	var cancelConnections = document.getElementsByClassName("cancelConnection");
	
	for (let i = 0; i < cancelConnections.length; i++) {
		cancelConnections[i].addEventListener("click", function() {
			var rowID = cancelConnections[i].id;
		 $.ajax({
  method: "POST",
  url: "/dashboard/cancel-connection-process.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('Connection has been removed!');
     window.location.href='/dashboard/account.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/dashboard/account.php';
	 }
			 } 
}); 
			
		});
	}
	
		// accept invitations
	
	var acceptInvitations = document.getElementsByClassName("acceptInvitation");
	
	for (let i = 0; i < acceptInvitations.length; i++) {
		acceptInvitations[i].addEventListener("click", function() {
			var rowID = acceptInvitations[i].id;
		 $.ajax({
  method: "POST",
  url: "/dashboard/accept-invitation-process.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('Connection has been verified!');
     window.location.href='/dashboard/account.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/dashboard/account.php';
	 }
			 } 
}); 
			
		});
	}
	
		// deny invitations
	
	var denyInvitations = document.getElementsByClassName("denyInvitation");
	
	for (let i = 0; i < denyInvitations.length; i++) {
		denyInvitations[i].addEventListener("click", function() {
			var rowID = denyInvitations[i].id;
		 $.ajax({
  method: "POST",
  url: "/dashboard/deny-invitation-process.php",
  data: { rowID: rowID },
 success: function(data){ 	
	 if (data) {
    window.alert('Connection invitation has been denied!');
     window.location.href='/dashboard/account.php';
	 } else {
		 window.alert('Error!');
  window.location.href='/dashboard/account.php';
	 }
			 } 
}); 
			
		});
	}
	
</script>

<?php include '../main-footer.php';?>
