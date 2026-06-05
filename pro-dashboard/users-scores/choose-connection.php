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


 $sql = "SELECT * FROM account_connections WHERE id = '$rowID'";   
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);

if($count > 0) {
			while($row = mysqli_fetch_array($result))
{
$_SESSION['chosenTraineeEmail'] = $row['trainee'];
			}
	echo true;
} else {
  echo false;
}

?>
