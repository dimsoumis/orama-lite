    <?php      

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
        $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  

if(isset($_POST['sendButton'])){
	
$userEmail = $_POST['emailAccount'];  
$tempPassword = $_POST['tempPassword'];
$userPassword = $_POST['newPassword'];  
      
        //to prevent from mysqli injection  
        $userEmail = stripcslashes($userEmail);  
        $userPassword = stripcslashes($userPassword);  
        $userEmail = mysqli_real_escape_string($con, $userEmail);  
        $userPassword = mysqli_real_escape_string($con, $userPassword);  
      
        $sql = "select * from trainees where email = '$userEmail'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

$sql2 = "select * from trainers where email = '$userEmail'";  
        $result2 = mysqli_query($con, $sql2);  
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
        $count2 = mysqli_num_rows($result2);  

$sql3 = "select * from password_resets where email = '$userEmail'";  
        $result3 = mysqli_query($con, $sql3);  
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);  
        $count3 = mysqli_num_rows($result3);  
          
// check if email is in users or therapists
        if($count != 1 && $count2 != 1) {  
			  echo "<script LANGUAGE='JavaScript'>window.alert('Email not registered with an account!');</script>";  
				echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
        } 
// check if email is in password resets
else if($count3 == 0) {  
echo "<script LANGUAGE='JavaScript'>window.alert('No active temporary password created for this account! Go to the reset password page first!');</script>";  
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
        } 
	// check if new password has whitespaces
else if (preg_match('/\s/', $userPassword)) {
	echo "<script LANGUAGE='JavaScript'>window.alert('The password cannot contain whitespaces!');</script>";  
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
		// check if new password has 8 or more characters
	else if (strlen($userPassword) < '8') {
echo "<script LANGUAGE='JavaScript'>window.alert('The password must be at least 8 characters long!');</script>";  
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
	}
// if email in users update password and delete temp password
else if($count == 1) { 
	
	
	$sql3_1 = "select * from password_resets where email = '$userEmail' and temp_password = '$tempPassword'";  
        $result3_1 = mysqli_query($con, $sql3_1);  
        $row3_1 = mysqli_fetch_array($result3_1, MYSQLI_ASSOC);  
        $count3_1 = mysqli_num_rows($result3_1); 
	
	if($count3_1 == 1) {
					$sql4 = "DELETE FROM password_resets WHERE email = '$userEmail'";
					$sql5 = "UPDATE trainees SET password = '$userPassword' WHERE email = '$userEmail'";
			
					if ($con->query($sql4) === TRUE) {	
						if ($con->query($sql5) === TRUE) {
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New password was successfully set! Login with your new password!');
    window.location.href='https://orama-lite.online/login.php';
    </script>");
} else {
echo "<script LANGUAGE='JavaScript'>window.alert('Password not updated sucessfully!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
} else {
echo "<script LANGUAGE='JavaScript'>window.alert('Password not updated sucessfully!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
	} else {
echo "<script LANGUAGE='JavaScript'>window.alert('The temporary password is incorrect!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
			}
// if email in therapists update password and delete temp password
else if($count2 == 1) { 
$sql3_2 = "select * from password_resets where email = '$userEmail' and temp_password = '$tempPassword'";  
        $result3_2 = mysqli_query($con, $sql3_2);  
        $row3_2 = mysqli_fetch_array($result3_2, MYSQLI_ASSOC);  
        $count3_2 = mysqli_num_rows($result3_2); 
	
	if($count3_2 == 1) {
					$sql6 = "DELETE FROM password_resets WHERE email = '$userEmail'";
					$sql7 = "UPDATE trainers SET password = '$userPassword' WHERE email = '$userEmail'";
			
					if ($con->query($sql6) === TRUE) {	
						if ($con->query($sql7) === TRUE) {
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New password was successfully set! Login with your new password!');
    window.location.href='https://orama-lite.online/login.php';
    </script>");
} else {
echo "<script LANGUAGE='JavaScript'>window.alert('Password not updated sucessfully!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
} else {
echo "<script LANGUAGE='JavaScript'>window.alert('Password not updated sucessfully!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
	} else {
echo "<script LANGUAGE='JavaScript'>window.alert('The temporary password is incorrect!');</script>"; 
echo '<script type="text/javascript">window.location.href = window.location.href;</script>'; 
}
	
		}

}
    ?>  


