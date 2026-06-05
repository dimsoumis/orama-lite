<?php include "sendMessage.php"; ?>
	<?php include 'main-head.php';?>
<?php include 'main-header.php';?>

<main id="contactPage">
<h1 id="pageTitle">Contact us</h1>
	<div class="row">
		<div class="column2">
<h2>We are always glad to hear from you!</h2>
			<p>If you have any questions, message us using the contact form of the page, and we will answer as soon as possible!</p>
	</div>
		<div class="column2">
			<h2>Contact Form</h2>
			<form id="formaEpikoinonias" method="post">
							<input id="firstNameField" name="firstNameField" type="text" placeholder="First Name" required>
			<input id="lastNameField" name="lastNameField" type="text" placeholder="Last Name" required>
			<input id="emailField" name="emailField" type="email" placeholder="Email" required>
			<textarea placeholder="Message" id="messageBody" name="messageBody" ></textarea>
			
			<input id="sendButton" type="submit" name="sendButton" value="Submit">
			</form>
	</div>
		</div>
</main>

<?php include 'main-footer.php';?>
