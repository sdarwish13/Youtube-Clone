<!DOCTYPE html>
<html>
	<head>
		<title>Sign in </title>
		<link rel="stylesheet" type="text/css" href="signin.css">
	</head>
	<body>
		<form action="" method="post">
			<div id="signin">
				<div id="lineh">
					<img id="youtubelogo" src="images/youtube logo.png" alt="youtube logo">
					<h1>Sign in</h1> 
					<p>Continue to Youtube</p>
				</div>

				<div id="mail">
					<input type="email" name="email" id="email" placeholder="Email"/>
				</div>

				<div id="pass">
					<input type="password" name="password" id="password" placeholder="Password"/>
				</div>

				<div>
					<button type="submit" id="signinbutton">Sign in</button>
				</div>

				<div>
					<p id="donthaveanaccount">Dont have an account? <a href="signup.php">Sign up</a></p>
				</div>
			</div>
			
			<?php
				
				error_reporting(0);
				$email = $_POST["email"];
				$password = $_POST["password"];
				
				if(!empty($email) && !empty($password)){
					try {
						$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
						$sql =$conn->query("SELECT * FROM Account WHERE email LIKE '%$email%'");
						foreach($sql as $row ){
							if ($email == $row["email"] && $password == $row["pass"]){
								$fname = $row["fname"];
								$lname = $row["lname"];
								$url = "homeAfter.php?fname=$fname&lname=$lname&email=$email";
								header("Location: " .$url);
							}
						}
						
						$message = "No account that matches these credentials exist.";
						echo "<script type='text/javascript'>alert('$message');</script>";								
						
						
					} catch(PDOException $e){
						echo $sql . "<br>" . $e->getMessage();
					}
				}
				
				$conn = null;
			
			?>
		</form>
	</body>
</html>