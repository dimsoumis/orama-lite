 <?php
session_start();
if(!isset($_SESSION['userEmail'])){
   header("Location: /");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>ORAMA lite - Fitness and Rehabilitation Exercises</title>
	<meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">

<link rel="icon" type="image/png" href="/images/favicon.png"/>

	 <script src="/scripts/sweetalert2.all.min.js"></script> 
	
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils_3d/control_utils_3d.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose/pose.js" crossorigin="anonymous"></script>
	
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision/vision_bundle.js" crossorigin="anonymous"></script>
	
	  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/hands/hands.js" crossorigin="anonymous"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	
	 	<!-- general file for flow in movement of three js elements -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
	

	
	

	

	

	