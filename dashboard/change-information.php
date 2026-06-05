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

?>




		
		<main id="changeInformationPage">
<h1 id="pageTitle">Change Information</h1>
			<p style="text-align: center;">Change below all the information you want, and submit the new data (the email of the account cannot change).</p>
	<div class="row">
		<div style="justify-content: center;
  display: flex;" class="column1">
			
				 <form style="max-width: 500px;
  width: 90%;
  text-align: center;" id="formaAllagisStoiheion" name="formaAllagisStoiheion" action="change-information-process.php"  method="POST">
					 
					 
					 
					 
					 	<?php if($count > 0) {
	
		
		while($row = mysqli_fetch_array($result)) {
			echo "<input id='firstNameRegister' name='firstNameRegister' type='text' placeholder='First Name' value='";
			echo $row['firstname'];
			echo "'><input id='lastNameRegister' name='lastNameRegister' type='text' placeholder='Last Name' value='";
	echo $row['lastname'];
			echo "'>	 <label for='dateOfBirthRegister'>Date of Birth</label>
				 <input id='dateOfBirthRegister' name='dateOfBirthRegister' type='date' value='";
	echo $row['date_of_birth'];
			echo "'><select id='genderRegister' name='genderRegister'>
  <option value='male' ";
			if ($row['gender'] == 'male') {
				echo "selected";
			}
			echo ">Male</option>
  <option value='female' ";
			if ($row['gender'] == 'female') {
				echo "selected";
			}
			echo ">Female</option>
</select>";
		
 
		
		}
	
		} 	else {
		echo "<p>There are no information.</p>";		
}
				?>
					 
			   <input id="sendButton" type="submit" value="Submit">
			 </form>
</div> 
	</div>
	

	
</main>
		
		

		

			



<?php include '../main-footer.php';?>
