<!DOCTYPE html>
<html>
	<head>
		<title>Sign up </title>
		<link rel="stylesheet" type="text/css" href="signup.css">
		<script src="signup.js" type="text/javascript"></script>
	</head>
	<body>
		<form action="" method="post">
			<div id="signup">
				<div id="lineh">
					<img id="youtubelogo" src="images/youtube logo.png" alt="youtube logo">
					<h1>Create your Youtube Account</h1> 
					<p>Continue to Youtube</p>
				</div>

				<div id="name">
					<input type="text" name="fname" id="fname" placeholder="First Name" size="20"/>
					<input type="text" name="lastname" id="lastname" placeholder="Last Name" size="20"/>
				</div>
				
				<div id="mail">
					<input type="email" name="email" id="email" placeholder="Your Email address"/>
				</div>				

				<div id="pass">
					<input type="password" name="password" id="password" placeholder="Password"/>
					<input type="password" name="confirm" id="confirm" placeholder="Confirm"/>				
				</div>
				
				<button type="submit" id="signupbutton" >Sign Up</button>
					<div id="signin">
						<a href="signin.php">Sign in instead</a>
					</div>
				</div>
			
						<?php
							
							error_reporting(0);
							$fname= $_POST["fname"];
							$lname= $_POST["lastname"];
							$email= $_POST["email"];
							$password= $_POST["password"];
							$confirm= $_POST["confirm"];
							
							if ($password != $confirm){
								$message = "Password and Confirm dont match!\nCouldn't create account.";
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
							if (!empty($fname) and !empty($lname) and !empty($email) and !empty($password) and $password == $confirm){
								
								try {
									$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "INSERT INTO account (fname, lname, email, pass)
									VALUES ('$fname', '$lname', '$email', '$password')";
									$sql2 = "INSERT INTO channel (owner, name) VALUES ('$email', '$fname')";
									$conn->exec($sql);
									$conn->exec($sql2);
									$url = "homeAfter.php?fname=$fname&lname=$lname&email=$email";
									header("Location: " .$url);
								} catch(PDOException $e){
									echo $sql . "<br>" . $e->getMessage();
								}
							}
							
							$conn = null;
							
						?>
			
			</form>
	</body>
</html>