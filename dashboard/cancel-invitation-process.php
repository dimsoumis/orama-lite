<?php

session_start();
if(!isset($_SESSION['userEmail'])){
   header("Location: /");
}

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
        $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  


$rowID = $_POST['rowID'];


 $sql = "DELETE FROM account_connections WHERE id = '$rowID'";  


if ($con->query($sql) === TRUE) {	
	echo true;
} else {
  echo false;
}

?>
