 <?php

session_start();
if(!isset($_SESSION['userEmail'])){
   header("Location: /");
}

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn, "utf8");

$previousPassword = $_POST['previousPassword'];
$registrantPassword = $_POST['passwordRegister'];
$registrantEmail = $_SESSION['userEmail'];


if (empty($previousPassword) OR empty($registrantPassword)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Try again, there were empty necessary fields');
    window.history.back();
    </script>");
} else {
	
	if (filter_var($registrantEmail, FILTER_VALIDATE_EMAIL)) {
				
		if (preg_match('/\s/', $registrantPassword)) {
				echo ("<script LANGUAGE='JavaScript'>
    window.alert('The password cannot contain whitespaces');
    window.history.back();
    </script>");
} else {

    if (strlen($registrantPassword) < '8') {
		echo ("<script LANGUAGE='JavaScript'>
    window.alert('The password must be at least 8 characters long');
    window.history.back();
    </script>");
	} 
		else {
			
			if ($registrantPassword == $previousPassword) {
					echo ("<script LANGUAGE='JavaScript'>
    window.alert('New password cannot be the same!');
    window.history.back();
    </script>");
			} else {
				
			
		$sql2 = "select * from trainers where email = '$registrantEmail'";  
        $result2 = mysqli_query($conn, $sql2);   
        $count2 = mysqli_num_rows($result2); 
				
				if($count2 > 0) {
		
		while($row2 = mysqli_fetch_array($result2)) {
					$currPassword = $row2['password'];
		}
				}
				
				
		if ($currPassword != $previousPassword) {	
			echo ("<script LANGUAGE='JavaScript'>
    window.alert('Wrong current password!');
    window.history.back();
    </script>");
		} else {
				
	$sql = "UPDATE trainers SET password = '$registrantPassword' WHERE email = '$registrantEmail'";


if ($conn->query($sql) === TRUE) {	
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New password created successfully! Use new password to log into the system!');
    window.location.href='/login.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
		}
		}
	}
	
	}
else {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Problem with account authorization!');
    window.history.back();
    </script>");
} 
	 
	
}


$conn->close(); 
?> 





