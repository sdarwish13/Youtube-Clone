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
							<p id="upload_vid_p">Enter the videos detail.</p>
							<span class="close">&times;</span>
							
						</div>
						<div id="upload_image_div">
							
							<form action="" method="post">
								<input type="text" name="title" placeholder="Enter the title" size="30"><br /><br />
								<textarea name="description" rows="7" cols="50" placeholder="Your video description"></textarea> <br /><br />
								<label>Private</label>
								<input type="radio" id="true" name="visibility" value="TRUE">
								<label>Public</label>
								<input type="radio" id="false" name="visibility" value="FALSE"><br />
								<p>Is there restriction on this video?</p>
								<label>Yes</label>
								<input type="radio" id="true" name="restriction" value="TRUE">
								<label>No</label>
								<input type="radio" id="false" name="restriction" value="FALSE"><br /><br />
								<button type="submit" id="submitbutton">Submit</button>
								
								
							</form>
							
						</div>
					
				  	</div>

				</div>
				
				<?php
					error_reporting(0);
					$title = $_POST["title"];
					$description = $_POST["description"];
					$visibility = $_POST["visibility"];
					$restriction = $_POST["restriction"];
					$input = $_COOKIE;
					$theid = $input["id"];
					$print_date = date("Y/m/d");
					
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];
					

					if ($visibility == "TRUE"){
						$visibility_boolean = 1;
					}elseif($visibility == "FALSE"){
						$visibility_boolean = 0;
					}
					if ($restriction == "TRUE"){
						$restriction_boolean = 1;
					}elseif($restriction == "FALSE"){
						$restriction_boolean = 0;
					}
					
					if(!empty($title) && !empty($description) && !empty($visibility)){
					try {
						$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
						$sql =$conn->query("SELECT id FROM Channel WHERE owner LIKE '%$email%'");
						foreach($sql as $row){
							$channel = $row["id"];
						};
						$sql2 =$conn->query("SELECT * FROM Video WHERE id LIKE '%$theid%'");
						foreach($sql2 as $row ){
							if($theid == $row["id"]){
								$inserting = "UPDATE Video SET title = '$title', description = '$description', channel= '$channel', private= '$visibility_boolean', restriction= '$restriction_boolean', upload_date = '$print_date' WHERE id= $theid" ;
								$conn->exec($inserting);
								$url = "upload_vid.php?fname=$fname&lname=$lname&email=$email";
								header("Location: " .$url);
							}
						}

					} catch(PDOException $e){
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
</html>