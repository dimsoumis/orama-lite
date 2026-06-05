<?php

// random string generator
			function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

// actions when form sent

if(isset($_POST['sendButton'])){


$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
        $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

$emailAccount = $_POST['emailAccount'];
$message = ""; 

//to prevent from mysqli injection  
        $emailAccount = stripcslashes($emailAccount);  
        $emailAccount = mysqli_real_escape_string($con, $emailAccount); 

	
	// check if email used in account
     $sql = "select * from trainees where email = '$emailAccount'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

$sql2 = "select * from trainers where email = '$emailAccount'";  
        $result2 = mysqli_query($con, $sql2);  
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
        $count2 = mysqli_num_rows($result2);  

        if($count != 1 && $count2 != 1){  
  echo ("<script LANGUAGE='JavaScript'>window.alert('Email not found in database!');</script>");  
				echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
        } 
        else {  
  // send email
	$to = $emailAccount; 
$tempPass = generateRandomString();
			
				$sql3 = "INSERT INTO password_resets (id, email, temp_password)
VALUES ('0', '$emailAccount', '$tempPass')";


if ($con->query($sql3) === TRUE) {	
	
	
if (!filter_var($emailAccount, FILTER_VALIDATE_EMAIL)) {
	echo '<script type="text/javascript">alert("Email address not valid!");</script>';
	echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
} else {

	$message = "<!DOCTYPE html>
	<html>
	<head>
	</head>
	<body>
	<p>Go to the page <a href='https://orama-lite.online/create-new-password.php' target='_blank'>https://orama-lite.online/create-new-password.php</a>, enter the email of your account and the temporary password given below, and create a new password for your account. The temporary password can be used only once.</p>
	<table rules='all' border='1' style='border-color: #666;' cellpadding='10'>
    <tr style='background: #eee;'><td colspan='2'><strong>ORAMA lite - Reset Account Password</strong> </td></tr>

    <tr>
        <td><strong>Email of Account:</strong></td>
        <td>".$_POST['emailAccount']."</td>
    </tr>
    <tr>
        <td><strong>Temporary Password:</strong></td>
        <td>".$tempPass."</td>
    </tr>
	</table>
	</body>
	</html>";
	
	$subject = "ORAMA lite - Reset Account Password";
	
	// Set content-type header for sending HTML email 
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	$headers .= "From: ORAMA lite Website <no-reply@orama-lite.online>\r\n" .
    "Reply-To: no-reply@orama-lite.online \r\n";
	
	$result = mail($to,$subject,$message,$headers);
	if ($result) {
		// $message = "Your Message was sent Successfully!";
		echo '<script type="text/javascript">alert("Check your mailbox for a message from our platform!");</script>';
		echo '<script type="text/javascript">window.location.href = window.location.href;</script>';

	}else{
		// $message = "Sorry! Message was not sent, Try again Later.";
		echo '<script type="text/javascript">alert("Sorry! Message was not sent, Try again Later.");</script>';
		echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
	}
	// header('Location: contact.php');
}
	
	} else {
  echo "Error: " . $sql3 . "<br>" . $con->error;
}
}
	
	  } 
?>