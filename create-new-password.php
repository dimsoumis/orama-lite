<?php include "create-new-password-process.php"; ?>
	<?php include 'main-head.php';?>
<?php include 'main-header.php';?>

<main id="createNewPasswordPage">
<h1 id="pageTitle">Create New Password</h1>
	
	<div class="row">
		<div class="column1">
			<p style="text-align: center;">Enter the email address of your account, the temporary password you received in your email and the new password you want to set for your account. Every temporary password can be used only once.</p> 
			 <form id="formaDimiourgiasNeouKodikou" method="POST">

			 <input id="emailAccount" name="emailAccount" type="email" placeholder="Your Email" required>
				 
<input id="tempPassword" name="tempPassword" type="password" autocomplete="new-password" placeholder="Temporary Password" required>	
				 
  <input id="newPassword" name="newPassword" type="password" autocomplete="new-password" placeholder="New Password" required>

				<input id="sendButton" type="submit" name="sendButton" value="Submit">
			 </form>
</div> 
	</div>
	

	
</main>

		

<?php include 'main-footer.php';?>
