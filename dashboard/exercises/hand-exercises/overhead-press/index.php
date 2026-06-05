
	
		<?php include '../../exercises-head.php';?>
	<link rel="stylesheet" href="styles.css">
	
	
	<script type="module">
		
		/*dim custom code 1 start*/
		
		var chosenHand = document.getElementById("chooseHand").value;
		var chosenWeight = document.getElementById("weightUsed").value;
		var chosenGoal =  document.getElementById("chooseGoal").value;
		var chosenMinutes = document.getElementById("goalTime").value;
		var chosenSeconds = document.getElementById("goalTime2").value;
		var chosenReps = document.getElementById("goalReps").value;
		
var exerActive = false;
var positionOfHand = "out";
		
var countTime;
var countRepeats;
var timeInterval;
		
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
	 
  const miti_x = results.poseLandmarks[0].x; 
  const miti_y = results.poseLandmarks[0].y;
  const miti_z = results.poseLandmarks[0].z;
	 
  const aGona_x = results.poseLandmarks[25].x; 
  const aGona_y = results.poseLandmarks[25].y;
  const aGona_z = results.poseLandmarks[25].z;
	 
  const dGona_x = results.poseLandmarks[26].x; 
  const dGona_y = results.poseLandmarks[26].y;
  const dGona_z = results.poseLandmarks[26].z;
   
  const aOmos_x = results.poseLandmarks[11].x; 
  const aOmos_y = results.poseLandmarks[11].y;
  const aOmos_z = results.poseLandmarks[11].z;
	 
 const dOmos_x = results.poseLandmarks[12].x; 
  const dOmos_y = results.poseLandmarks[12].y;
  const dOmos_z = results.poseLandmarks[12].z;
	 
  const aAgon_x = results.poseLandmarks[13].x; 
  const aAgon_y = results.poseLandmarks[13].y;
  const aAgon_z = results.poseLandmarks[13].z;
	 
  const dAgon_x = results.poseLandmarks[14].x; 
  const dAgon_y = results.poseLandmarks[14].y;
  const dAgon_z = results.poseLandmarks[14].z;
	 
  const aKarp_x = results.poseLandmarks[15].x; 
  const aKarp_y = results.poseLandmarks[15].y;
  const aKarp_z = results.poseLandmarks[15].z;
	 
  const dKarp_x = results.poseLandmarks[16].x; 
  const dKarp_y = results.poseLandmarks[16].y;
  const dKarp_z = results.poseLandmarks[16].z;
	 
	if (exerActive) {
	
		if (miti_y > 1 || miti_y < 0 || dGona_y > 1 || dGona_y < 0 || aGona_y > 1 || aGona_y < 0 || dOmos_x > 1 || dOmos_x < 0 || aOmos_x > 1 || aOmos_x < 0 || dAgon_x > 1 || dAgon_x < 0 || aAgon_x > 1 || aAgon_x < 0 || dKarp_x > 1 || dKarp_x < 0 || aKarp_x > 1 || aKarp_x < 0 || dKarp_y > 1 || dKarp_y < 0 || aKarp_y > 1 || aKarp_y < 0) {
			document.getElementById("areaForMessages").style.display = "block";
		document.getElementById("areaForMessages").innerHTML = "<span style='color: #f00;'>Important Message:</span><br>Please place yourself properly in the frame. Your whole body should be visible by the camera!";	
			positionOfHand = "out";
		} else 	if (Math.abs(dKarp_x - dOmos_x) > 0.15 || Math.abs(aKarp_x - aOmos_x) > 0.15) {
	document.getElementById("areaForMessages").style.display = "block";
		document.getElementById("areaForMessages").innerHTML = "<span style='color: #f00;'>Important Message:</span><br>Keep your hands closer to your body!";	
			positionOfHand = "out";
		} else {
		document.getElementById("areaForMessages").style.display = "none";
		document.getElementById("areaForMessages").innerHTML = "";	
			if (chosenHand == "left") {
				if (aOmos_y < aAgon_y && aAgon_y < aKarp_y) {
					positionOfHand = "down";
					  drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#0000FF', lineWidth: 2});
				} else if (aOmos_y > aAgon_y && aAgon_y > aKarp_y) {
				if (positionOfHand == "down") {
					countRepeats++;
					if (chosenGoal == "reps") {
					document.getElementById("currentRepeat").innerHTML = (chosenReps - countRepeats) + " left";
					} else {
						document.getElementById("currentRepeat").innerHTML = countRepeats;	
					}
				}
					positionOfHand = "up";
					drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#00FF00', lineWidth: 2});
				}
			} if (chosenHand == "right") {
					if (dOmos_y < dAgon_y && dAgon_y < dKarp_y) {
					positionOfHand = "down";
						 drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#0000FF', lineWidth: 2});
				} else if (dOmos_y > dAgon_y &&  dAgon_y > dKarp_y) {
				if (positionOfHand == "down") {
					countRepeats++;
					if (chosenGoal == "reps") {
					document.getElementById("currentRepeat").innerHTML = (chosenReps - countRepeats) + " left";
					} else {
						document.getElementById("currentRepeat").innerHTML = countRepeats;	
					}
				}
					positionOfHand = "up";
					drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#00FF00', lineWidth: 2});
				}
			} else {
					if (aOmos_y < aAgon_y && dOmos_y < dAgon_y && aAgon_y < aKarp_y && dAgon_y < dKarp_y) {
					positionOfHand = "down";
						 drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#0000FF', lineWidth: 2});
				} else if (aOmos_y > aAgon_y && dOmos_y > dAgon_y &&  aAgon_y > aKarp_y && dAgon_y > dKarp_y) {
				if (positionOfHand == "down") {
					countRepeats++;
					if (chosenGoal == "reps") {
					document.getElementById("currentRepeat").innerHTML = (chosenReps - countRepeats) + " left";
					} else {
						document.getElementById("currentRepeat").innerHTML = countRepeats;	
					}
				}
					positionOfHand = "up";
					drawLandmarks(canvasCtx, results.poseLandmarks, {color: '#00FF00', lineWidth: 2});
				}
			}
		if (chosenGoal == "reps" && chosenReps == countRepeats) {
			finishExer();
		}
		}
			
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

	
			document.getElementById("startExercise").addEventListener("click", setStartAuto);
		
		document.getElementById("timeForStartingPosition").value = 0;
		document.getElementById("weightUsed").value = 0;
		document.getElementById("goalReps").value = 0;
		document.getElementById("goalTime").value = 0;
		document.getElementById("goalTime2").value = 0;
		
function setStartAuto() {
	 chosenHand = document.getElementById("chooseHand").value;
	chosenWeight = document.getElementById("weightUsed").value;
	chosenGoal =  document.getElementById("chooseGoal").value;
	chosenMinutes = document.getElementById("goalTime").value;
	chosenSeconds = document.getElementById("goalTime2").value;
		chosenReps = document.getElementById("goalReps").value;
	if (chosenHand != "left" && chosenHand != "right" && chosenHand != "both") {
			alert("Please Choose Hand for Exercise!");
	} else if (chosenGoal != "time" && chosenGoal != "reps") {
			alert("Please Choose Exercising Goal!");
	} else if (chosenGoal == "time" && chosenMinutes == 0 && chosenSeconds == 0) {
			alert("Please Specify Goal Time!");
	} else if (chosenGoal == "reps" && chosenReps == 0) {
			alert("Please Specify Goal Repetitions!");
	} else { 
		document.getElementById("currentWeight").innerHTML = chosenWeight + "gr";
		if (chosenGoal == "reps") {
			document.getElementById("currentRepeat").innerHTML = chosenReps + " left";
			} else {
				if (chosenMinutes > 9 && chosenSeconds > 9) {
			document.getElementById("currentTime").innerHTML = chosenMinutes + ":" + chosenSeconds + " left";
				} else if  (chosenMinutes > 9) {
			document.getElementById("currentTime").innerHTML = chosenMinutes + ":0" + chosenSeconds + " left";
				} else if  (chosenSeconds > 9) {
			document.getElementById("currentTime").innerHTML = "0" + chosenMinutes + ":" + chosenSeconds + " left";
				} else {
					document.getElementById("currentTime").innerHTML = "0" + chosenMinutes + ":0" + chosenSeconds + " left";
				}
			}
		if (chosenHand == "left") {
			document.getElementById("currentHand").innerHTML = "Left Hand";
		} else if (chosenHand == "right") {
			document.getElementById("currentHand").innerHTML = "Right Hand";
		} else {
			document.getElementById("currentHand").innerHTML = "Both Hands";
		} 
		document.getElementById("introScreenOverlay").style.display = "none";
			document.getElementById("introScreen").style.display = "none";
		
			var timeoutSet = document.getElementById("timeForStartingPosition").value;
			timeoutSet++;
			
			if (timeoutSet == 1) {
				document.getElementById("countdownForSetters").style.display = "block";
			}
				
			var countDownInter = setInterval( function () {
							timeoutSet--;
				document.getElementById("countdownForSetters").innerHTML = timeoutSet;
				document.getElementById("countdownForSetters").style.display = "block";
				if (timeoutSet < 1) {
					document.getElementById("countdownForSetters").innerHTML = "";
					document.getElementById("countdownForSetters").style.display = "none";
					
				    clearInterval(countDownInter);
					startCounting();
				}
			}, 1000);
	}
		}
		
		
		
		
		
		
		
		
		
		
		function startCounting() {
			
			exerActive = true;
			document.getElementById("cancelExer").style.display = "block";
			// reps chosen goal
				if (chosenGoal == "reps") {
					countTime = 0;
					countRepeats = 0;
					
					timeInterval = setInterval(function () {
			
		countTime++;
			 
				 if (countTime < 10) {
				  document.getElementById("currentTime").innerHTML = "00:0" + countTime;
				 } else if (countTime < 60) {
				  document.getElementById("currentTime").innerHTML = "00:" + countTime;
				 } else if (countTime < 600) {
					 var curMinutes = Math.floor(countTime / 60);
					 var curSeconds = countTime - (curMinutes * 60);
					 if (curSeconds < 10) {
				  document.getElementById("currentTime").innerHTML = "0" + curMinutes + ":0" + curSeconds;
					 } else {
						  document.getElementById("currentTime").innerHTML = "0" + curMinutes + ":" + curSeconds;
					 }
				 } else if (countTime < 3600) {
				  var curMinutes = Math.floor(countTime / 60);
					 var curSeconds = countTime - (curMinutes * 60);
					 if (curSeconds < 10) {
				  document.getElementById("currentTime").innerHTML = curMinutes + ":0" + curSeconds;
					 } else {
						  document.getElementById("currentTime").innerHTML = curMinutes + ":" + curSeconds;
					 }
				 } else {
				  document.getElementById("currentTime").innerHTML = "1:00:00";
					 clearInterval(timeInterval);
					 exerActive = false;
			localStorage.setItem("overheadPressRepeats", countRepeats);
			 localStorage.setItem("overheadPressTime", 3600);
					 localStorage.setItem("overheadPressWeight", chosenWeight);
					  localStorage.setItem("overheadPressHand", chosenHand);
							  		        Swal.fire({
title: 'Maximum time of 60 minutes reached. You made ' + countRepeats + ' repetitions.',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Play Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
location.reload(); 
  } else if (result.isDenied) {
	window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/hand-exercises/index.php";
  }
});
				 }
				 }, 1000);
				}
				// time chosen goal
			else {
				countTime = Number(chosenMinutes * 60) + Number(chosenSeconds);
					countRepeats = 0;
					
					timeInterval = setInterval(function () {
				countTime--;
						if (countTime == 0) {
				  document.getElementById("currentTime").innerHTML = "00:00 left";
					 clearInterval(timeInterval);
					 exerActive = false;
			localStorage.setItem("overheadPressRepeats", countRepeats);
			 localStorage.setItem("overheadPressTime", ((chosenMinutes * 60) + chosenSeconds));
					 localStorage.setItem("overheadPressWeight", chosenWeight);
					  localStorage.setItem("overheadPressHand", chosenHand);
							  		        Swal.fire({
title: 'Time limit has been reached. You made ' + countRepeats + ' repetitions.',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Play Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
location.reload(); 
  } else if (result.isDenied) {
	window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/hand-exercises/index.php";
  }
});
				 } else if (countTime < 10) {
				  document.getElementById("currentTime").innerHTML = "00:0" + countTime + " left";
				 } else if (countTime < 60) {
				  document.getElementById("currentTime").innerHTML = "00:" + countTime + " left";
				 } else if (countTime < 600) {
					 var curMinutes = Math.floor(countTime / 60);
					 var curSeconds = countTime - (curMinutes * 60);
					 if (curSeconds < 10) {
				  document.getElementById("currentTime").innerHTML = "0" + curMinutes + ":0" + curSeconds + " left";
					 } else {
						  document.getElementById("currentTime").innerHTML = "0" + curMinutes + ":" + curSeconds + " left";
					 }
				 } else if (countTime < 3600) {
				  var curMinutes = Math.floor(countTime / 60);
					 var curSeconds = countTime - (curMinutes * 60);
					 if (curSeconds < 10) {
				  document.getElementById("currentTime").innerHTML = curMinutes + ":0" + curSeconds + " left";
					 } else {
						  document.getElementById("currentTime").innerHTML = curMinutes + ":" + curSeconds + " left";
					 }
				 } 
					
				 }, 1000);
				}
			
			}

		
		
		
		
		
			function finishExer() {
					 clearInterval(timeInterval);
					 exerActive = false;
			localStorage.setItem("overheadPressRepeats", countRepeats);
			 localStorage.setItem("overheadPressTime", countTime);
					 localStorage.setItem("overheadPressWeight", chosenWeight);
					  localStorage.setItem("overheadPressHand", chosenHand);
							  		        Swal.fire({
title: 'Goal of ' + countRepeats + ' repetitions achieved in ' + countTime + ' seconds.',
showDenyButton: true,
showCancelButton: true,
  confirmButtonText: `Play Again`,
  denyButtonText: `Save Score`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
location.reload(); 
  } else if (result.isDenied) {
	window.location.href = "save-score.php";
  } else {
window.location.href = "/dashboard/exercises/hand-exercises/index.php";
  }
});
			}
		

		
		
			document.getElementById("cancelExer").addEventListener("click", cancelCurrentExerFun);
		
		function cancelCurrentExerFun() {
	 clearInterval(timeInterval);
					 exerActive = false;
				document.getElementById("areaForMessages").style.display = "none";
		document.getElementById("areaForMessages").innerHTML = "";	
	 Swal.fire({
title: 'Exercise canceled.',
showDenyButton: true,
showCancelButton: false,
  confirmButtonText: `Play Again`,
  denyButtonText: `Go Back`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
location.reload(); 
  } else if (result.isDenied) {
window.location.href = "/dashboard/exercises/hand-exercises/index.php";
  } else {
window.location.href = "/dashboard/exercises/hand-exercises/index.php";
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
		<p><label for="chooseHand">Exercising Hand:</label>
		<select name="chooseHand" id="chooseHand">
   <option value="" disabled selected hidden>Choose</option>
<option value="left">Left Hand</option>
  <option value="right">Right Hand</option>
  <option value="both">Both Hands</option>
</select></p>
		
<p><label for="weightUsed">Weight used:</label> <input type="number" id="weightUsed" name="weightUsed" min="0" max="20000"> grams.</p>
		
		<div style="margin: 15px 0px; text-align: center;"><label for="chooseGoal">Exercising Goal:</label>
		<select name="chooseGoal" id="chooseGoal">
   <option value="" disabled selected hidden>Choose</option>
<option value="time">Time</option>
  <option value="reps">Repetitions</option>
</select>
		<div id="timeGoal" style="display: none; margin-top: 15px;"><label for="goalTime">Specify in minutes and seconds:</label> <input type="number" id="goalTime" name="goalTime" min="0" max="59">:<input type="number" id="goalTime2" name="goalTime2" min="0" max="59"></div>	
		<div id="repsGoal" style="display: none; margin-top: 15px;"><label for="goalReps">No of Repetitions:</label> <input type="number" id="goalReps" name="goalReps" min="0" max="20000"></div>
		</div>
		
		<p><label for="timeForStartingPosition">Time needed to go to starting position:</label> <input type="number" id="timeForStartingPosition" name="timeForStartingPosition" min="0" max="60"> seconds.</p>
		
		<button style="margin: 15px 0px;" id="startExercise">Start Exercise</button>
	</div>
	
	
	
	
	
	<div id="exerNtimeSpace">
	<div id="currentExerMessage">Exercise: Overhead Press (<div id="currentHand"></div>)</div>
	
	<div id="timerMessage">Time: <div id="currentTime">-</div></div>
		
		<div id="repeatsMessage">Repeats: <div id="currentRepeat">-</div></div>
		
		<div id="weightMessage">Weight: <div id="currentWeight">-</div></div>
		
		<button id="cancelExer" style="display: none; margin: 15px auto 0px auto;">Cancel Exercise</button>
	  </div>

	
	
	<div id="countdownForSetters"></div>
	
	<div id="areaForMessages"></div>
	
	<a href="../index.php"><button id="goBackButt">Go Back</button></a>
	
	<script>
		document.getElementById("chooseGoal").addEventListener("click", function() {
			if (document.getElementById("chooseGoal").value == "time") {
				document.getElementById("timeGoal").style.display = "block";
				document.getElementById("repsGoal").style.display = "none";
			} else if (document.getElementById("chooseGoal").value == "reps") {
				document.getElementById("repsGoal").style.display = "block";
				document.getElementById("timeGoal").style.display = "none";
			}
		});
	</script>
</body>
</html>