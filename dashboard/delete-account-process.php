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
				
		
		$tables = array("bicep_curls", "sit_to_stand_5_repeats", "sit_to_stand_10_repeats", "sit_to_stand_30_secs", "sit_to_stand_60_secs");
foreach($tables as $table) {
  $query = "DELETE FROM $table WHERE user='$registrantEmail'";
  mysqli_query($conn,$query);
}
		
$sql = "DELETE FROM trainees WHERE email = '$registrantEmail'";

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





