<?php
$message = ""; 
if(isset($_POST['sendButton'])){
	$to = "dimsoumis@go.uop.gr"; // Your email address
	$firstname = $_POST['firstNameField'];
	$lastname = $_POST['lastNameField'];
	$from = $_POST['emailField'];
	
if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
	echo '<script type="text/javascript">alert("Email address not valid!");</script>';
	echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
} else {

	$message = "<!DOCTYPE html>
	<html>
	<head>
	</head>
	<body>
	<table rules='all' border='1' style='border-color: #666;' cellpadding='10'>
    <tr style='background: #eee;'><td colspan='2'><strong>ORAMA lite Contact Form</strong> </td></tr>
    <tr>
        <td><strong>First Name:</strong></td>
        <td>".$_POST['firstNameField']."</td>
    </tr>
    <tr>
        <td><strong>Last Name:</strong></td>
        <td>".$_POST['lastNameField']."</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>".$_POST['emailField']."</td>
    </tr>
    <tr>
        <td><strong>Message:</strong></td>
        <td>".$_POST['messageBody']."</td>
    </tr>
	</table>
	</body>
	</html>";
	
	$subject = "ORAMA lite Contact Form";
	
	// Set content-type header for sending HTML email 
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	$headers .= "From: ORAMA lite Website <" . $from . ">\r\n" .
    'Reply-To: ' . $from . "\r\n";
	
	$result = mail($to,$subject,$message,$headers);
	if ($result) {
		// $message = "Your Message was sent Successfully!";
		echo '<script type="text/javascript">alert("Your Message was sent Successfully!");</script>';
		echo '<script type="text/javascript">window.location.href = window.location.href;</script>';

	}else{
		// $message = "Sorry! Message was not sent, Try again Later.";
		echo '<script type="text/javascript">alert("Sorry! Message was not sent, Try again Later.");</script>';
		echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
	}
	// header('Location: contact.php');
}
}
?>