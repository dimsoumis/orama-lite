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

$registrantFirstName = $_POST['firstNameRegister'];
$registrantLastName = $_POST['lastNameRegister'];
$registrantDateOfBirth = $_POST['dateOfBirthRegister'];
$registrantGender = $_POST['genderRegister'];

$registrantEmail = $_SESSION['userEmail'];

if (empty($registrantDateOfBirth) OR empty($registrantGender)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Try again, there were empty necessary fields');
    window.history.back();
    </script>");
} else {
	

	
	$sql = "UPDATE trainers SET firstname = '$registrantFirstName', lastname = '$registrantLastName', date_of_birth = '$registrantDateOfBirth', gender = '$registrantGender' WHERE email = '$registrantEmail'";


if ($conn->query($sql) === TRUE) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Record updated successfully!');
    window.location.href='/pro-dashboard/account.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
	
	

	 
	



$conn->close(); 
?> 





