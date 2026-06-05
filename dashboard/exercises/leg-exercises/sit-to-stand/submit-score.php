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
$score = $_POST['score']; 
$time = $_POST['time']; 
$var = $_POST['var']; 
      
        //to prevent from mysqli injection   
        $user = stripcslashes($user);    
        $user = mysqli_real_escape_string($con, $user);  
          
   
			
			$sql = "INSERT INTO sit_to_stand (id, user, score, time, variation)
VALUES ('0', '$user', '$score', '$time', '$var')";
			
			
			
if ($con->query($sql) === TRUE) {	
   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Your Score has been saved!');
    window.location.href='/dashboard/exercises/leg-exercises/index.php';
    </script>");  
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}     
       


    ?>  




