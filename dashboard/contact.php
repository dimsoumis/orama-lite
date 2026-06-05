
	<?php include 'loggedin-head.php';?>

<main id="contactPage">
<h1 id="pageTitle">Contact us</h1>
	<div class="row">
		<div class="column2">
<h2>We are always glad to hear from you!</h2>
			<p>If you have any questions, message us using the contact form of the page, and we will answer as soon as possible!</p>
	</div>
		<div class="column2">
			<h2>Contact Form</h2>
			<form id="formaEpikoinonias" action="sendMessage.php">
							<input id="firstNameField" name="firstNameField" type="text" placeholder="First Name" >
			<input id="lastNameField" name="lastNameField" type="text" placeholder="Last Name" >
			<input id="emailField" name="emailField" type="email" placeholder="Email" >
			<textarea placeholder="Message" id="messageBody" name="messageBody" ></textarea>
			
			<input id="sendButton" type="button" value="Submit">
			</form>
	</div>
		</div>
</main>

<?php include '../main-footer.php';?>
