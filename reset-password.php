<?php include "reset-password-process.php"; ?>
	<?php include 'main-head.php';?>
<?php include 'main-header.php';?>

<main id="resetPasswordPage">
<h1 id="pageTitle">Reset Password</h1>
	
	<div class="row">
		<div class="column1">
			<p style="text-align: center;">Enter the email address of your account and you will receive a mail with instructions on resetting your password.</p> 
			 <form id="formaAllagisKodikou" method="POST">

			 <input id="emailAccount" name="emailAccount" type="email" placeholder="Your Email" required>

				<input id="sendButton" type="submit" name="sendButton" value="Submit">
			 </form>
</div> 
	</div>
	

	
</main>

		

<?php include 'main-footer.php';?>
