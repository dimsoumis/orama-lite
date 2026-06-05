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

$registrantEmail = $_SESSION['userEmail'];



	
	if (filter_var($registrantEmail, FILTER_VALIDATE_EMAIL)) {
				
		

		
$sql = "DELETE FROM trainers WHERE email = '$registrantEmail'";

if ($conn->query($sql) === TRUE) {	
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Account and all relevant data deleted!');
    window.location.href='/login.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
else {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Problem with account authorization!');
    window.history.back();
    </script>");
} 
	 
	

$conn->close(); 
?> 





