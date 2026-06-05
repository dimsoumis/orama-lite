
	<?php include 'main-head.php';?>
<?php include 'main-header.php';?>

<main id="loginPage">
<h1 id="pageTitle">Login</h1>
	<div class="row">
		<div class="column1">
			 <form id="formaEisodou" action="login-process.php" onsubmit="return validation()" method="POST">
			<input id="emailLogin" name="emailLogin" type="email" placeholder="Email">
<input id="passwordLogin" name="passwordLogin" type="password" placeholder="Password">
			<input id="sendButton" type="submit" value="Submit">
			 </form>
</div> 
	</div>
	
		<div class="row">
		<div class="column1">
<p style="text-align: center;">Don't have an account?<br>
	<a href="/register.php">Register as a Trainee</a> / <a href="/register-pro.php">Register as a Trainer</a></p>
</div> 
	</div>
	
		<div class="row">
		<div class="column1">
<p style="text-align: center;">Forgot your password?<br>
	<a href="/reset-password.php">Reset Password</a></p>
</div> 
	</div>
	
</main>

		 <script>  
            function validation()  
            {  
                var userName=document.getElementById("emailLogin").value;  
                var passWord=document.getElementById("passwordLogin").value;  
                if(userName.length == "" && passWord.length == "") {  
                    alert("Email and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(userName.length == "") {  
                        alert("Email field is empty");  
                        return false;  
                    }   
                    if (passWord.length == "") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
			 
		
        </script>  

<?php include 'main-footer.php';?>
