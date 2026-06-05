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

$traineesEmail = $_POST['traineesEmail'];
$trainersEmail = $_SESSION['userEmail'];


if (empty($trainersEmail)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Try again, there were empty necessary fields');
    window.history.back();
    </script>");
} else {
	
	if (filter_var($trainersEmail, FILTER_VALIDATE_EMAIL)) {
					
$select = mysqli_query($conn, "SELECT * FROM account_connections WHERE trainee = '".$traineesEmail."' AND trainer = '".$trainersEmail."'");
$select2 = mysqli_query($conn, "SELECT * FROM trainees WHERE email = '".$traineesEmail."'");		
		if(mysqli_num_rows($select)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('You have already an active connection or a connection request with this user!');
    window.history.back();
    </script>");
} else {
			
			if(mysqli_num_rows($select2)) {
			$sql = "INSERT INTO account_connections (id, trainee, trainer, verified)
VALUES ('0', '$traineesEmail', '$trainersEmail', 'By Trainer')";


if ($conn->query($sql) === TRUE) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New connection request created successfully!');
  window.history.back();
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
			} else {				
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('There is no trainee account associated with the email you provided!');
    window.history.back();
    </script>");
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





