<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="upload_vid.css">
</head>
<body onload="myfunction()">
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
						<div id="header">
							<p id="upload_vid_p">Tell us more about yourself.</p>
							<span class="close">&times;</span>
							
						</div>
						<div id="upload_image_div">
							
							<form action="" method="post">
								<input type="text" name="title" placeholder="What is the name of your channel" size="30"><br /><br />
								<textarea name="description" rows="7" cols="50" placeholder="How would you describe your channel?"></textarea> <br /><br />
								<button type="submit" id="submitbutton">Submit</button>
								
								
							</form>
							
						</div>
					
				  	</div>

				</div>
				
				<?php
					error_reporting(0);
					$title = $_POST["title"];
					$description = $_POST["description"];
					
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];

					if(!empty($title) && !empty($description)){
					try {
						$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
						$sql =$conn->query("SELECT * FROM Channel WHERE owner LIKE '%$email%'");
						foreach($sql as $row){
							if ($row["owner"] == $email){
								$inserting = "UPDATE Channel SET name = '$title', description = '$description' WHERE owner = '$email'" ;
								$conn->exec($inserting);
								$url = "homeAfter.php?fname=$fname&lname=$lname&email=$email";
								header("Location: " .$url);								
							}
						}
					}catch(PDOException $e){
					echo $sql2 . "<br>" . $e->getMessage();
				}

				} 
				
				$conn = null;
					
				?>
				
				
				<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("buttonme");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			function myfunction() {
			  modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
				modal.style.display = "none";
			  }
			}
			
			function openwindow(){
				window.open("upload_form.html", "_self");
			}
			</script>
</body>