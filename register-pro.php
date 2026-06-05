
	<?php include 'main-head.php';?>
<?php include 'main-header.php';?>

<main id="registerPage">
<h1 id="pageTitle">Register as a Trainer</h1>
	<div class="row">
		<div class="column1">
			 <form id="formaEggrafis" name="formaEggrafis" action="register-pro-process.php"  method="POST">
		<input id="firstNameRegister" name="firstNameRegister" type="text" placeholder="First Name">
				  <input id="lastNameRegister" name="lastNameRegister" type="text" placeholder="Last Name">
			 <input id="emailRegister" name="emailRegister" type="email" placeholder="Email">
  <input id="passwordRegister" name="passwordRegister" type="password" placeholder="Password">
				 <label for="dateOfBirthRegister">Date of Birth</label>
				 <input id="dateOfBirthRegister" name="dateOfBirthRegister" type="date">
				 <select id="genderRegister" name="genderRegister">
<option value="" disabled selected>Select Gender</option>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
		

			   <input id="sendButton" type="submit" value="Submit">
			 </form>
</div> 
	</div>
	
		<div class="row">
		<div class="column1">
<p style="text-align: center;">Already have an account?<br>
	<a href="/login.php">Login</a></p>
</div> 
	</div>
	
</main>

		

<?php include 'main-footer.php';?>
