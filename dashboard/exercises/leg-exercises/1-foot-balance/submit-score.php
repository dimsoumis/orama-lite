    <?php      

 session_start();

$servername = "localhost";
$username = "orama";
$password = "MLLwoqgor5ih8!1&";
$dbname = "orama";
          
        $con = mysqli_connect($servername, $username, $password, $dbname);  
        if(mysqli_connect_errno()) {  
            die("Failed to connect with MySQL: ". mysqli_connect_error());  
        }  




$user = $_SESSION['userEmail'];  
$time = $_POST['time']; 
$leg = $_POST['leg']; 
      
        //to prevent from mysqli injection   
        $user = stripcslashes($user);    
        $user = mysqli_real_escape_string($con, $user);  
          
   
			
			$sql = "INSERT INTO one_foot_balance (id, user, leg, time)
VALUES ('0', '$user', '$leg', '$time')";
			
			
			
if ($con->query($sql) === TRUE) {	
   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Your Score has been saved!');
    window.location.href='/dashboard/exercises/leg-exercises/index.php';
    </script>");  
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}     
       


    ?>  




