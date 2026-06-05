<html>
<head>
	<meta charset="utf-8">
		  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
<title>Lateral Raises</title>
<link rel="icon" type="image/png" href="/images/favicon.png"/>
	
	<link rel="stylesheet" href="/styles/main.css">
	<link rel="stylesheet" href="/styles/responsive.css">
  </head>
  
  <body class="saveScorePage" style="display: flex;
  justify-content: center;">
	  <main>
	  <h1 style="text-align: center; margin-top: 50px; margin-bottom: 100px;">Are you sure you want to save your score?</h1>
	  
	    <div class="row" style="font-size: 25px;">
			 <div class="column4" style="flex-direction: row; justify-content: center;"><strong>Hand</strong>: <div id="handUsed" style="display: inline; margin-left: 7px;"></div></div>
			 <div class="column4" style="flex-direction: row; justify-content: center;"><strong>Score</strong>: <div id="scoreAchieved" style="display: inline; margin-left: 7px;"></div></div>
			 <div class="column4" style="flex-direction: row; justify-content: center;"><strong>Time</strong>: <div id="timeAchieved" style="display: inline; margin-left: 7px;"></div></div>
			<div class="column4" style="flex-direction: row; justify-content: center;"><strong>Weight</strong>: <div id="weightUsed" style="display: inline; margin-left: 7px;"></div></div>
	  </div>
	  
	  <div class="row">
		  
		  
		  <div class="column1">
		  <form action="submit-score.php" method="POST">
			  <input id="score" name="score" type="number" style="display: none;" /><br/>
			   <input id="weight" name="weight" type="number" style="display: none;" /><br/>
			  <input id="time" name="time" type="number" style="display: none;" /><br/>
			  <input id="hand" name="hand" type="text" style="display: none;" /><br/>
		  <input id="submitScore" type="submit" value="Yes">
	  </form>
	  </div>
		  </div>
	  
	  <hr style="color: #fff;
height: 5px;
background: #fff;
margin: 40px 0px;">
	  
	   <div class="row">
		  <div class="column2">
	  <a href="index.php"><button>Play Again</button></a> 
			   </div>
		   	  <div class="column2">
	  <a href="../index.php"><button>Go Back</button></a> 
		   </div>
		  </div>
	  
	  </main>
		  <script type="text/javascript"> 
			  
			  
			 var userScore = localStorage.getItem("lateralRaisesRepeats");
			var userTime = Number(localStorage.getItem("lateralRaisesTime"));
					 var userWeight = localStorage.getItem("lateralRaisesWeight");
					  var userHand = localStorage.getItem("lateralRaisesHand");
			  
			  
			  
			  
			  
			  
			  
			  
			  if (userTime < 10) {
				  document.getElementById("timeAchieved").innerHTML = "00:0" + userTime;
				 } else if (userTime < 60) {
				  document.getElementById("timeAchieved").innerHTML = "00:" + userTime;
				 } else if (userTime < 600) {
					 var userMinutes = Math.floor(userTime / 60);
					 var userSeconds = userTime - (userMinutes * 60);
					 if (userSeconds < 10) {
				 document.getElementById("timeAchieved").innerHTML = "0" + userMinutes + ":0" + userSeconds;
					 } else {
				 document.getElementById("timeAchieved").innerHTML = "0" + userMinutes + ":" + userSeconds;
					 }
				 } else if (userTime < 3600) {
				  var userMinutes = Math.floor(userTime / 60);
					 var userSeconds = userTime - (userMinutes * 60);
					 if (userSeconds < 10) {
				 document.getElementById("timeAchieved").innerHTML = userMinutes + ":0" + userSeconds;
					 } else {
						  document.getElementById("timeAchieved").innerHTML = userMinutes + ":" + userSeconds;
					 }
				 } else {
					  document.getElementById("timeAchieved").innerHTML = "1:00:00";
				 }
			  
			  
			  
			  document.getElementById("scoreAchieved").innerHTML = userScore;
  document.getElementById("score").setAttribute('value', userScore);
			  
			    document.getElementById("weightUsed").innerHTML = userWeight + " gr";
  document.getElementById("weight").setAttribute('value', userWeight);
			  
  document.getElementById("time").setAttribute('value', userTime);
			  
			   document.getElementById("handUsed").innerHTML = userHand;
  document.getElementById("hand").setAttribute('value', userHand);
			  
	  </script>
  </body>
</html>

