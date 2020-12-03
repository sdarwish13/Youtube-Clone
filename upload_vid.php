<!DOCTYPE html>

<html>
	<head>
		<title>Channel videos - Upload</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="upload_vid.css">
	</head>
	
	<body id="body">

		<div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube studio.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form>
                    <img src="images/search logo.png" alt="Search">
                    <input type="text" id="searchText" placeholder="Search">
				</form>
            </div>
            <div id="buttons">
                <button id="buttonme">
					<i style="color:red;font-size:16px;" class="fa fa-upload"></i> Upload 
				</button>
                <input type="button" id="profileImage">
            </div>
		</div>
		

		<div class="vertNav">
            <ul>
                <li>
                    <input type="button" id="profileImage">
				</li>
				<li id="urvidBtn">
                    <a href="home.html">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="playlistBtn">
                    <a href="home.html">
                        <img src="images/playlist.png" alt="Playlist Image">
                        <p>Playlists</p>
                    </a>
                </li>
            </ul>
        </div>
		
		
		<div class="videos">
			<p id="channel_videos">Channel videos</p>
		
			
			<div id="sorting">
				<div id="checkboxvid">
					<label class="checkbox_vid">
						<input type="checkbox" name="checkvideos"/>Videos
					</label>
				</div>
				<div id="visibility">
					<span>Visibility</span>
				</div>
				<div id="restrictions">
					<span>Restrictions</span>
				</div>
				<div id="date">
					<span>Date</span>
				</div>
				<div id="views">
					<span>Views</span>
				</div>
				<div id="comments">
					<span>Comments</span>
				</div>
				<div id="likes">
					<span>Likes (vs. dislikes)</span>
				</div>
			</div>
			
			
			<div id="display_videos">
				
				<?php
				
					$db = new PDO("mysql:dbname=278project", "root","");
					$rows = $db->query("SELECT * FROM video");
					foreach($rows as $row){
						?>
						<ul>
							<video width="200" height="200" controls>
								<source src="test_uploads/<?php echo $row["name"] ?>" type="video/mp4">
							</video>
							<span id="centerit"><?php echo $row["name"] ?> </span>
						</ul>
						<?php
					}
				
				?>
				
			</div>
			
			
		</div>
		
			
				<!-- The Modal -->
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
						<div id="header">
							<p id="upload_vid_p">Upload videos</p>
							<span class="close">&times;</span>
							
						</div>
						<div id="upload_image_div">
							<img id="upload_image"style="height:75px;width:75px;"src="images/upload.png" alt="upload image">
							
							<p id="drag_drop_p">Drag and drop video files to upload</p>
							
							<p id="private_until_p">Your videos will be private until you publish them.</p>
							
							<!--<input type="file" id="actual-btn" hidden/>
							<label id="select_files" style="font-size:16px" for="actual-btn">SELECT FILES </label>
							<p id="donthaveanaccount">Dont have an account? <a href="upload_form.html">Sign up</a></p>
							-->
							
							<button id="select_files" style="font-size:16px" onclick="openwindow()">SELECT FILES </button>
							
							
							<p class="footer_p">By sumitting your videos to Youtube, you acknowledge that you agree to Youtube's <a href="https://www.youtube.com/t/terms">Term's Service </a>and  <a href="https://www.youtube.com/howyoutubeworks/policies/community-guidelines/">Community Guidelines.</a></p>
							
							<p class="footer_p">Please make sure that you do not violate others' copyright orr privacy rights. <a href="https://www.youtube.com/howyoutubeworks/policies/copyright/">Learn more</a></p>
						</div>
					
				  	</div>

				</div>

		
		
		
			<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("buttonme");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
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