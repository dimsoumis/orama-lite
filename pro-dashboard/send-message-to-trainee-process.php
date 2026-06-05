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
$message = $_POST['messageToTrainee'];


if (empty($traineesEmail) OR empty($message)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Try again, there were empty necessary fields');
    window.history.back();
    </script>");
} else {
	
	if (filter_var($trainersEmail, FILTER_VALIDATE_EMAIL)) {
					
$select = mysqli_query($conn, "SELECT * FROM account_connections WHERE trainee = '".$traineesEmail."' AND trainer = '".$trainersEmail."' AND verified = 'By Both'");
		
		if(mysqli_num_rows($select)) {	
	

			$sql = "INSERT INTO trainers_messages (id, trainee, trainer, message, message_from, message_to)
VALUES ('0', '$traineesEmail', '$trainersEmail', '$message', '$trainersEmail', '$traineesEmail')";


if ($conn->query($sql) === TRUE) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New message sent successfully!');
  window.history.back();
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
			} else {				
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('There is no verified connection with that email account!');
    window.history.back();
    </script>");
			}
		}
	}

	 
	


$conn->close(); 
?> 





