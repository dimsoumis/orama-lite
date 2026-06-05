
	<?php include 'loggedin-head.php';?>


<main id="changePasswordPage">
<h1 id="pageTitle">Change Password</h1>
	<div class="row">
		<div class="column1">
			 <form id="formaAllagisKodikou" name="formaAllagisKodikou" action="change-password-process.php"  method="POST">
	
		  <input id="previousPassword" name="previousPassword" type="password" autocomplete="new-password" placeholder="Current Password">		 
  <input id="passwordRegister" name="passwordRegister" type="password" autocomplete="new-password" placeholder="New Password">
				
				 
			   <input id="sendButton" type="submit" value="Submit">
			 </form>
</div> 
	</div>
	

	
</main>

<?php include '../main-footer.php';?>
		
		
		
		
		
		
		
		
		
		
		
		
		



