
	
		<?php include '../../exercises-head.php';?>
	<link rel="stylesheet" href="styles.css">
	
	
	<script type="module">
		
		/*dim custom code 1 start*/
		
		var chosenFoot = document.getElementById("chooseVar").value;
		
		var exerActive = false;
		
				
var countTime;
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
   
  const aOmos_x = results.poseLandmarks[11].x; 
  const aOmos_y = results.poseLandmarks[11].y;
  const aOmos_z = results.poseLandmarks[11].z;
	 
 const dOmos_x = results.poseLandmarks[12].x; 
  const dOmos_y = results.poseLandmarks[12].y;
  const dOmos_z = results.poseLandmarks[12].z;
	 
const aAstra_x = results.poseLandmarks[27].x;
const aAstra_y = results.poseLandmarks[27].y;
const aAstra_z = results.poseLandmarks[27].z;
	 
const dAstra_x = results.poseLandmarks[28].x;
const dAstra_y = results.poseLandmarks[28].y;
const dAstra_z = results.poseLandmarks[28].z;
	 
	if (exerActive) {
		if (miti_y > 1 || miti_y < 0 || dOmos_x > 1 || dOmos_x < 0 || aOmos_x > 1 || aOmos_x < 0 || aAstra_x > 1 || aAstra_x < 0 || aAstra_y > 1 || aAstra_y < 0 || dAstra_x > 1 || dAstra_x < 0 || dAstra_y > 1 || dAstra_y < 0) {
	 clearInterval(timeInterval);
					 exerActive = false;
				document.getElementById("areaForMessages").style.display = "none";
		document.getElementById("areaForMessages").innerHTML = "";	
Swal.fire({
title: 'Exercise failed!<br>Please place yourself properly in the frame. Your whole body should be visible by the camera!',
showDenyButton: true,
showCancelButton: false,
  confirmButtonText: `Play Again`,
  denyButtonText: `Go Back`,
  cancelButtonText: `Go Back`,
}).then((result) => {
  if (result.isConfirmed) {
location.reload(); 
  } else if (result.isDenied) {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
		} else {
				if (chosenFoot == "left") {
			if (aAstra_y <= (dAstra_y + 0.05)) {
			finishExer();	
			}
		} else if (chosenFoot == "right") {
		if (dAstra_y <= (aAstra_y + 0.05)) {
			finishExer();	
			}
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
		
	document.getElementById("startExercise").addEventListener("click", startExer);
		document.getElementById("timeForStartingPosition").value = 0;
		
		function startExer() {
				chosenFoot = document.getElementById("chooseVar").value;
			var timeoutSet = document.getElementById("timeForStartingPosition").value;
			if (chosenFoot != "left" && chosenFoot != "right") {
			alert("Please Choose Foot to Exercise!");
	} else if (timeoutSet == 0) {
			alert("Please specify needed time to go to starting position!");
	} else {
			document.getElementById("introScreenOverlay").style.display = "none";
			document.getElementById("introScreen").style.display = "none";
		if (chosenFoot == "left") {
			document.getElementById("currentVar").innerHTML = "Left Foot";
		} else if (chosenFoot == "right") {
			document.getElementById("currentVar").innerHTML = "Right Foot";
		}
		
			timeoutSet++;
				
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
			
				countTime = 0;
					
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
			localStorage.setItem("oneFootBalanceTime", 3600);
					 localStorage.setItem("oneFootBalanceFoot", chosenFoot);
							  		        Swal.fire({
title: 'Congratulations! Maximum time of 60 minutes reached!',
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
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
				 }
				 }, 1000);
		
		
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
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  } else {
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
					 }
		
		
		
		
		
		function finishExer() {
			 clearInterval(timeInterval);
					 exerActive = false;
			localStorage.setItem("oneFootBalanceTime", countTime);
					 localStorage.setItem("oneFootBalanceFoot", chosenFoot);
			
			if (countTime > 5) {
							  		        Swal.fire({
title: 'Congratulations! You balanced for ' + countTime + ' seconds!',
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
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
			} else {
										  		        Swal.fire({
title: 'You balanced for ' + countTime + ' seconds!',
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
window.location.href = "/dashboard/exercises/leg-exercises/index.php";
  }
});
			}
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
		<p><label for="chooseVar">Foot to balance on:</label>
		<select name="chooseVar" id="chooseVar">
   <option value="" disabled selected hidden>Choose</option>
<option value="right">Right</option>
<option value="left">Left</option>
</select></p>
		
	

			<p style="text-align: center;"><label for="timeForStartingPosition">Time needed to go to starting position:</label> <input type="number" id="timeForStartingPosition" name="timeForStartingPosition" min="3" max="60"> seconds.<br>(minimum 3 / maximum 60 seconds)</p>
		
		<button style="margin: 15px 0px;" id="startExercise">Start Exercise</button>
	</div>
	
	
	
	
	
	<div id="exerNtimeSpace">
	<div id="currentExerMessage">Exercise: 1-Foot Balance (<div id="currentVar"></div>)</div>
	
	<div id="timerMessage">Time: <div id="currentTime">-</div></div>
		
		
		<button id="cancelExer" style="display: none; margin: 15px auto 0px auto;">Cancel Exercise</button>
	  </div>

	
	
	<div id="countdownForSetters"></div>
	
	<div id="areaForMessages"></div>
	
	<a href="../index.php"><button id="goBackButt">Go Back</button></a>
	

</body>
</html>