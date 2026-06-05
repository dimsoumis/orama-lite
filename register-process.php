 <?php

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
$registrantEmail = $_POST['emailRegister'];
$registrantPassword = $_POST['passwordRegister'];
$registrantDateOfBirth = $_POST['dateOfBirthRegister'];
$registrantGender = $_POST['genderRegister'];


if (empty($registrantEmail) OR empty($registrantPassword) OR empty($registrantDateOfBirth) OR empty($registrantGender)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Try again, there were empty necessary fields');
    window.history.back();
    </script>");
} else {
	
	if (filter_var($registrantEmail, FILTER_VALIDATE_EMAIL)) {
		
		$select = mysqli_query($conn, "SELECT * FROM trainees WHERE email = '".$registrantEmail."'");
		$select2 = mysqli_query($conn, "SELECT * FROM trainers WHERE email = '".$registrantEmail."'");
if(mysqli_num_rows($select)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('This email is already used!');
    window.history.back();
    </script>");
} else if(mysqli_num_rows($select2)) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('This email is used for the account of a trainer! Please use a different email!');
    window.history.back();
    </script>");
} else {
				
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
	$sql = "INSERT INTO trainees (id, firstname, lastname, email, password, date_of_birth, gender)
VALUES ('0', '$registrantFirstName', '$registrantLastName', '$registrantEmail', '$registrantPassword', '$registrantDateOfBirth', '$registrantGender')";


if ($conn->query($sql) === TRUE) {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('New record created successfully! You can now log in to the system!');
    window.location.href='/login.php';
    </script>");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
	}
	}
}
	
else {	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid email address');
    window.history.back();
    </script>");
} 
	 
	
}


$conn->close(); 
?> 





