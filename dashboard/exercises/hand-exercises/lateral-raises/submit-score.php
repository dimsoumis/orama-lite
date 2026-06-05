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
$weight = $_POST['weight']; 
$time = $_POST['time']; 
$hand = $_POST['hand']; 
      
        //to prevent from mysqli injection   
        $user = stripcslashes($user);    
        $user = mysqli_real_escape_string($con, $user);  
          
   
			
			$sql = "INSERT INTO lateral_raises (id, user, score, time, weight, hand)
VALUES ('0', '$user', '$score', '$time', '$weight', '$hand')";
			
			
			
if ($con->query($sql) === TRUE) {	
   echo ("<script LANGUAGE='JavaScript'>
    window.alert('Your Score has been saved!');
    window.location.href='/dashboard/exercises/hand-exercises/index.php';
    </script>");  
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}     
       


    ?>  




