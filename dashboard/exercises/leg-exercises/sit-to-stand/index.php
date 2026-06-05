
	
		<?php include '../../exercises-head.php';?>
	<link rel="stylesheet" href="styles.css">
	
	
	<script type="module">
		
		/*dim custom code 1 start*/
		
  var aLekan_x; 
  var aLekan_y;
  var aLekan_z;
	 
  var dLekan_x; 
  var dLekan_y;
  var dLekan_z;
	 
  var aGona_x; 
  var aGona_y;
  var aGona_z;
	
  var dGona_x; 
  var dGona_y;
  var dGona_z;
		
  var aOmos_x; 
  var aOmos_y;
  var aOmos_z;
	 
  var dOmos_x; 
  var dOmos_y;
  var dOmos_z;
		
  var aAgon_x; 
  var aAgon_y;
  var aAgon_z;
	
  var dAgon_x; 
  var dAgon_y;
  var dAgon_z;
		
	 var aKarp_x; 
 var aKarp_y;
  var aKarp_z;
	
  var dKarp_x; 
  var dKarp_y;
  var dKarp_z;
		
  var aStoma_x; 
  var aStoma_y;
  var aStoma_z;
		
 var miti_x; 
 var miti_y;
 var miti_z;
		
var chosenVar;
var countTime;
var countReps;
var timeToSit;
var timeToStand;
var timeToStart;

var exerActive = false;
var heriaSosta = false;

var aGonaCloseToLekan = false;
var dGonaCloseToLekan = false;	
		
var aGonaFarFromLekan = false;
var dGonaFarFromLekan = false;	
		
var userSitting = 0;
		
var sitDistThres = 0;
var standDistThres = 0;

var countRepeatsInterval;		
		/*dim custom code 1 end*/
		
 const videoElement = document.getElementsByClassName('input_video')[0]; 
const canvasElement = document.getElementsByClassName('output_canvas')[0];
const canvasCtx = canvasElement.getContext('2d');
/* const landmarkContainer = document.getElementsByClassName('landmark-grid-container')[0];
const grid = new LandmarkGrid(landmarkContainer); */

 function onResults(results) {
  if (!results.poseLandmarks) {
  /*  grid.updateLandmarks([]); */
    return;
  } 

  canvasCtx.save();
  canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
  canvasCtx.drawImage(results.segmentationMask, 0, 0,
                      canvasElement.width, canvasElement.height);

  // Only overwrite existing pixels.
  canvasCtx.globalCompositeOperation = 'source-in';
  //canvasCtx.fillStyle = '#00FF00';
	canvasCtx.fillStyle = '#00FF0000';
  canvasCtx.fillRect(0, 0, canvasElement.width, canvasElement.height);

  // Only overwrite missing pixels.
  canvasCtx.globalCompositeOperation = 'destination-atop';
  canvasCtx.drawImage(
      results.image, 0, 0, canvasElement.width, canvasElement.height);

  canvasCtx.globalCompositeOperation = 'source-over';
  drawConnectors(canvasCtx, results.poseLandmarks, POSE_CONNECTIONS,
                 {color: '#000000', lineWidth: 4});
  drawLandmarks(canvasCtx, results.poseLandmarks,
                {color: '#FF0000', lineWidth: 2});
	/*dim custom code 2 start*/
		const body = results.poseLandmarks[0];
	 
 miti_x = results.poseLandmarks[0].x; 
 miti_y = results.poseLandmarks[0].y;
 miti_z = results.poseLandmarks[0].z;
	 
aStoma_x = results.poseLandmarks[9].x; 
  aStoma_y = results.poseLandmarks[9].y;
 aStoma_z = results.poseLandmarks[9].z;
	 
 aLekan_x = results.poseLandmarks[23].x; 
 aLekan_y = results.poseLandmarks[23].y;
 aLekan_z = results.poseLandmarks[23].z;
	 
  dLekan_x = results.poseLandmarks[24].x; 
 dLekan_y = results.poseLandmarks[24].y;
  dLekan_z = results.poseLandmarks[24].z;
	 
 aGona_x = results.poseLandmarks[25].x; 
 aGona_y = results.poseLandmarks[25].y;
 aGona_z = results.poseLandmarks[25].z;
	 
 dGona_x = results.poseLandmarks[26].x; 
 dGona_y = results.poseLandmarks[26].y;
 dGona_z = results.poseLandmarks[26].z;
   
 aOmos_x = results.poseLandmarks[11].x; 
 aOmos_y = results.poseLandmarks[11].y;
 aOmos_z = results.poseLandmarks[11].z;
	 
 dOmos_x = results.poseLandmarks[12].x; 
 dOmos_y = results.poseLandmarks[12].y;
 dOmos_z = results.poseLandmarks[12].z;
	 
 aAgon_x = results.poseLandmarks[13].x; 
 aAgon_y = results.poseLandmarks[13].y;
 aAgon_z = results.poseLandmarks[13].z;
	 
 dAgon_x = results.poseLandmarks[14].x; 
 dAgon_y = results.poseLandmarks[14].y;
 dAgon_z = results.poseLandmarks[14].z;
	 
 aKarp_x = results.poseLandmarks[15].x; 
 aKarp_y = results.poseLandmarks[15].y;
 aKarp_z = results.poseLandmarks[15].z;
	 
 dKarp_x = results.poseLandmarks[16].x; 
 dKarp_y = results.poseLandmarks[16].y;
 dKarp_z = results.poseLandmarks[16].z;
	 
	 heriaSosta = (dKarp_x >= dAgon_x) && (aKarp_x <= aAgon_x) && (dKarp_y <= dAgon_y) && (aKarp_y <= aAgon_y) && (aStoma_y <= dKarp_y) && (aStoma_y <= aKarp_y);
	 
	  if (exerActive && !heriaSosta) {
	 cancelCauseBadHands();
	 }
	 
	 aGonaCloseToLekan = (aLekan_y > aGona_y - sitDistThres);
	 dGonaCloseToLekan = (dLekan_y > dGona_y - sitDistThres);
	 
	 if (aGonaCloseToLekan && dGonaCloseToLekan && heriaSosta) {
		  if (exerActive) {
		 drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#FFFF00', lineWidth: 2});
		  }
			 userSitting = 1;
	 }
	 
	 
	 	 aGonaFarFromLekan = (aLekan_y < aGona_y - standDistThres);
	 dGonaFarFromLekan = (dLekan_y < dGona_y - standDistThres);

	 if (aGonaFarFromLekan && dGonaFarFromLekan && heriaSosta) {
		  if (exerActive) {
			  		 drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#00FF00', lineWidth: 2});
			 if (userSitting == 1) {
				 
				 	if (chosenVar == "sec30" || chosenVar == "sec60") {
				 countReps++;
				 document.getElementById("currentRepeat").innerHTML = countReps;
				}  else if (chosenVar == "reps5" || chosenVar == "reps10") {
						 countReps--;
					document.getElementById("currentRepeat").innerHTML = countReps + " left";
					if (countReps == 0) {
						finishExer();
					}
				}
			 }
		 }
		  userSitting = 2;
	 }
	 
	
	 
	
	/*dim custom code 2 end*/
  
	 canvasCtx.restore();

  /* grid.updateLandmarks(results.poseWorldLandmarks); */
}

const pose = new Pose({locateFile: (file) => {
  return `https://cdn.jsdelivr.net/npm/@mediapipe/pose/${file}`;
}});
pose.setOptions({
  modelComplexity: 1,
  smoothLandmarks: true,
  enableSegmentation: true,
  smoothSegmentation: true,
  minDetectionConfidence: 0.5,
  minTrackingConfidence: 0.5
});
pose.onResults(onResults);

const camera = new Camera(videoElement, {
  onFrame: async () => {
    await pose.send({image: videoElement});
  },
  width: 1280,
  height: 720
});
camera.start();
		
		
		
		
		/*dim custom code 3 start*/

	document.getElementById("startCalibration").addEventListener("click", beginCalibrating);
	
		function beginCalibrating() {
	chosenVar = document.getElementById("chooseVar").value;
	timeToSit = document.getElementById("timeForSittingPosition").value;
	timeToStand = document.getElementById("timeForStandingPosition").value;
	timeToStart = document.getElementById("timeForStartingPosition").value;
			if (chosenVar != "sec30" && chosenVar != "sec60" && chosenVar != "reps5" && chosenVar != "reps10") {
					alert("Please Choose Variation!");
			} else if (timeToSit < 3 || timeToSit > 60 || timeToStand < 3 || timeToStand > 60 || timeToStart < 3 || timeToStart > 60) {
				alert("Please Assign Valid Values to Timers!");
			} else {
				if (chosenVar == "sec30") {
						document.getElementById("currentVar").innerHTML = "30 seconds";
					countTime = 30;
					countReps = 0;
				} else if (chosenVar == "sec60") {
						document.getElementById("currentVar").innerHTML = "60 seconds";
					countTime = 60;
					countReps = 0;
				} else if (chosenVar == "reps5") {
						document.getElementById("currentVar").innerHTML = "5 repetitions";
					countTime = 0;
					countReps = 5;
				} else if (chosenVar == "reps10") {
						document.getElementById("currentVar").innerHTML = "10 repetitions";
					countTime = 0;
					countReps = 10;
				}
		
			document.getElementById("introScreenOverlay").style.display = "none";
			document.getElementById("introScreen").style.display = "none";
				
			
			var countDownInterSitting = setInterval( function () {
				document.getElementById("countdownForSetters").innerHTML = timeToSit;
				document.getElementById("countdownForSetters").style.display = "block";
				if (timeToSit < 1) {
					document.getElementById("countdownForSetters").innerHTML = "";
					document.getElementById("countdownForSetters").style.display = "none";
					
				    clearInterval(countDownInterSitting);
					setSitting();
				}
			timeToSit--;	
			}, 1000);
			}
		}
		
		
		
		
		function setSitting() {
			
			if (miti_y > 1 || miti_y < 0 || dGona_y > 1 || dGona_y < 0 || aGona_y > 1 || aGona_y < 0 || dOmos_x > 1 || dOmos_x < 0 || aOmos_x > 1 || aOmos_x < 0 || dAgon_x > 1 || dAgon_x < 0 || aAgon_x > 1 || aAgon_x < 0) {
Swal.fire({
title: 'Calibration failed! Body not positioned properly inside the frame!',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Recalibrate with same settings`,
  denyButtonText: `Change Settings`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
beginCalibrating(); 
  } else if (result.isDenied) {
location.reload(); 
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		} else {
	 var leftKneeLimbDistance =  Number(aGona_y - aLekan_y);
	 var rightKneeLimbDistance = Number(dGona_y - dLekan_y);
				
				if (leftKneeLimbDistance < rightKneeLimbDistance) {
					leftKneeLimbDistance = rightKneeLimbDistance;
				}
				
				leftKneeLimbDistance = Number(leftKneeLimbDistance);
					sitDistThres = leftKneeLimbDistance + 0.05;
			
			document.getElementById("areaForMessages").style.display = "block";
		document.getElementById("areaForMessages").innerHTML = "<span style='color: #00f;'>Important Message:</span><br>Sitting threshold has been set. Stand up to register standing threshold!";	
			
			setTimeout(function() {
					document.getElementById("areaForMessages").style.display = "none";
		document.getElementById("areaForMessages").innerHTML = "";	
					var countDownInterStanding = setInterval( function () {
				document.getElementById("countdownForSetters").innerHTML = timeToStand;
				document.getElementById("countdownForSetters").style.display = "block";
				if (timeToStand < 1) {
					document.getElementById("countdownForSetters").innerHTML = "";
					document.getElementById("countdownForSetters").style.display = "none";
					
				    clearInterval(countDownInterStanding);
					setStanding();
				}
			timeToStand--;	
			}, 1000);
			}, 5000);
			
			
		}	
			
		}
		
		
		
		
		
		
		
		
		
		function setStanding() {
			
		if (miti_y > 1 || miti_y < 0 || dGona_y > 1 || dGona_y < 0 || aGona_y > 1 || aGona_y < 0 || dOmos_x > 1 || dOmos_x < 0 || aOmos_x > 1 || aOmos_x < 0 || dAgon_x > 1 || dAgon_x < 0 || aAgon_x > 1 || aAgon_x < 0) {
Swal.fire({
title: 'Calibration failed! Body not positioned properly inside the frame!',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Recalibrate with same settings`,
  denyButtonText: `Change Settings`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
beginCalibrating(); 
  } else if (result.isDenied) {
location.reload(); 
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		} else {
			 var leftKneeLimbDistance =  Number(aGona_y - aLekan_y);
	 var rightKneeLimbDistance = Number(dGona_y - dLekan_y);
				
				if (leftKneeLimbDistance > rightKneeLimbDistance) {
					leftKneeLimbDistance = rightKneeLimbDistance;
				}
				
				leftKneeLimbDistance = Number(leftKneeLimbDistance);
				standDistThres = leftKneeLimbDistance - 0.05;
			
			if (standDistThres <= sitDistThres) {
				Swal.fire({
title: 'Calibration failed!',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Recalibrate with same settings`,
  denyButtonText: `Change Settings`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
beginCalibrating(); 
  } else if (result.isDenied) {
location.reload(); 
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
			} else {
				document.getElementById("areaForMessages").style.display = "block";
		document.getElementById("areaForMessages").innerHTML = "<span style='color: #00f;'>Important Message:</span><br>Standing threshold has been set. Sit down to start the exercise!";	
			
			setTimeout(function() {
					document.getElementById("areaForMessages").style.display = "none";
		document.getElementById("areaForMessages").innerHTML = "";	
					var countDownInterStarting = setInterval( function () {
				document.getElementById("countdownForSetters").innerHTML = timeToStart;
				document.getElementById("countdownForSetters").style.display = "block";
				if (timeToStart < 1) {
					document.getElementById("countdownForSetters").innerHTML = "";
					document.getElementById("countdownForSetters").style.display = "none";
					
				    clearInterval(countDownInterStarting);
					startExercise();
				}
			timeToStart--;	
			}, 1000);
			}, 5000);
			}
					
					
		}
			
		}
		
		
		
		
		function startExercise() {
			userSitting = 0;
			exerActive = true;
			document.getElementById("cancelExer").style.display = "block";
			
				 	if (chosenVar == "sec30" || chosenVar == "sec60") {
						countTime++;
				countRepeatsInterval = setInterval(function () {
				countTime--;
				var minutes = Math.trunc(countTime / 60);
				var seconds = countTime - (minutes * 60);
					
				if (minutes < 10 && seconds < 10) {
				   document.getElementById("currentTime").innerHTML = "0" + minutes + ":" + "0" + seconds + " left";
				 } else if (minutes < 10) {
				  document.getElementById("currentTime").innerHTML = "0" + minutes + ":" + seconds + " left";
				 } else if (minutes > 10 && seconds < 10) {
				 document.getElementById("currentTime").innerHTML = minutes + ":" + "0" + seconds + " left";
				 } else {
				  document.getElementById("currentTime").innerHTML = minutes + ":" + seconds + " left";
				 }
		if (countTime == 0) {
			finishExer();
		}	
				 }, 1000);
				}  else if (chosenVar == "reps5" || chosenVar == "reps10") {
						countRepeatsInterval = setInterval(function () {
				countTime++;
				var minutes = Math.trunc(countTime / 60);
				var seconds = countTime - (minutes * 60);
					
				if (minutes < 10 && seconds < 10) {
				   document.getElementById("currentTime").innerHTML = "0" + minutes + ":" + "0" + seconds;
				 } else if (minutes < 10) {
				  document.getElementById("currentTime").innerHTML = "0" + minutes + ":" + seconds;
				 } else if (minutes > 10 && seconds < 10) {
				 document.getElementById("currentTime").innerHTML = minutes + ":" + "0" + seconds;
				 } else {
				  document.getElementById("currentTime").innerHTML = minutes + ":" + seconds;
				 }
		if (countTime == 3600) {
			cancelCauseTooMuchTime();
		}	
				 }, 1000);
				}
				
			if (chosenVar == "reps5" || chosenVar == "reps10") {
			document.getElementById("currentRepeat").innerHTML = countReps + " left";
			} 
			
		}
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		function  cancelCauseBadHands() {
						clearInterval(countRepeatsInterval);
					 exerActive = false;
		
							  		        Swal.fire({
title: 'Exercise cancelled due to wrong posture!',
showDenyButton: false,
showCancelButton: true,
  confirmButtonText: `Try Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
   location.reload();
  } else if (result.isDenied) {
window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		}
		
			function  cancelCauseTooMuchTime() {
			clearInterval(countRepeatsInterval);
					 exerActive = false;
		
							  		        Swal.fire({
title: 'Exercise cancelled due to too much time passed!',
showDenyButton: false,
showCancelButton: true,
  confirmButtonText: `Try Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
   location.reload();
  } else if (result.isDenied) {
window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		}
		
		
		
		document.getElementById("cancelExer").addEventListener("click", cancelExercise);
		
		function cancelExercise() {
								clearInterval(countRepeatsInterval);
					 exerActive = false;
		
							  		        Swal.fire({
title: 'Exercise cancelled!',
showDenyButton: false,
showCancelButton: true,
  confirmButtonText: `Try Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
   location.reload();
  } else if (result.isDenied) {
window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		}
		
		function finishExer() {
						 clearInterval(countRepeatsInterval);
					 exerActive = false;
					 localStorage.setItem("sitToStandChosenVar", chosenVar);
			if (chosenVar == "sec30") {
			localStorage.setItem("sitToStandTime", 30);
				localStorage.setItem("sitToStandReps", countReps);
				countTime = 30;
			} else if (chosenVar == "sec60") {
			localStorage.setItem("sitToStandTime", 60);
				localStorage.setItem("sitToStandReps", countReps);
				countTime = 60;
			}  else if (chosenVar == "reps5") {
			localStorage.setItem("sitToStandTime", countTime);
				localStorage.setItem("sitToStandReps", 5);
				countReps = 5;
			} else if (chosenVar == "reps10") {
			localStorage.setItem("sitToStandTime", countTime);
				localStorage.setItem("sitToStandReps", 10);
				countReps = 10;
			} 
		
							  		        Swal.fire({
title: 'Exercise completed! You made ' + countReps + ' repetitions in ' + countTime + ' seconds.',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Try Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
   location.reload();
  } else if (result.isDenied) {
window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		}
		
		/*dim custom code 3 end*/
		
</script>
</head>

<body>
  <div class="container">
     <video style="display: none;" class="input_video"></video> 
    <canvas class="output_canvas" width="1920px" height="1080px"></canvas>
   <!-- <div class="landmark-grid-container"></div> -->
  </div>
	
	
	<div id="introScreenOverlay"></div>
	<!-- Intro Screen-->
	<div id="introScreen">
		<p><label for="chooseVar">Sit-to-Stand Variation:</label>
		<select name="chooseVar" id="chooseVar">
   <option value="" disabled selected hidden>Choose</option>
<option value="sec30">30 seconds</option>
  <option value="sec60">60 seconds</option>
  <option value="reps5">5 repetitions</option>
<option value="reps10">10 repetitions</option>
</select></p>
		
	
		<p style="text-align: center;"><u>You need to calibrate your body measurements in sitting and standing positions before starting the exercise.</u></p>
		
		<p style="text-align: center;"><label for="timeForSittingPosition">Time needed to go to starting (sitting) position:</label> <input type="number" id="timeForSittingPosition" name="timeForSittingPosition" min="3" max="60"> seconds.<br>(minimum 3 / maximum 60 seconds)</p>
		
				<p style="text-align: center;"><label for="timeForStandingPosition">Time needed to stand up after sitting:</label> <input type="number" id="timeForStandingPosition" name="timeForStandingPosition" min="3" max="60"> seconds.<br>(minimum 3 / maximum 60 seconds)</p>
		
			<p style="text-align: center;"><label for="timeForStartingPosition">Interval between end of calibration and start of the exercise:</label> <input type="number" id="timeForStartingPosition" name="timeForStartingPosition" min="3" max="60"> seconds.<br>(minimum 3 / maximum 60 seconds)</p>
		
		<button style="margin: 15px 0px;" id="startCalibration">Start Calibration</button>
	</div>
	
	
	
	
	
	<div id="exerNtimeSpace">
	<div id="currentExerMessage">Exercise: Sit to Stand (<div id="currentVar"></div>)</div>
	
	<div id="timerMessage">Time: <div id="currentTime">-</div></div>
		
		<div id="repeatsMessage">Repeats: <div id="currentRepeat">-</div></div>
		
		<button id="cancelExer" style="display: none; margin: 15px auto 0px auto;">Cancel Exercise</button>
	  </div>

	
	
	<div id="countdownForSetters"></div>
	
	<div id="areaForMessages"></div>
	
	<a href="../index.php"><button id="goBackButt">Go Back</button></a>
	

</body>
</html>